<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ServiceManManagement;

use App\CentralLogics\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\ProviderManagement\Serviceman;

class ServiceManController extends Controller
{
    private Serviceman $serviceman;
//    private Booking $booking;
    private $moduleId;
    public function __construct
    (
        Serviceman $serviceman,
//        Booking $booking
    )
    {
        $this->serviceman = $serviceman;
        $this->moduleId = request()->header('moduleid');
//        $this->booking = $booking;
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'required|in:active,inactive,all'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $serviceman = $this->serviceman->where('service_provider_id', auth('provider')->user()->id)
            ->when($request->has('string'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $keys = explode(' ', base64_decode($request['string']));
                    foreach ($keys as $key) {
                        $query->orWhere('first_name', 'LIKE', '%' . $key . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $key . '%')
                            ->orWhere('email', 'LIKE', '%' . $key . '%')
                            ->orWhere('identification_number', 'LIKE', '%' . $key . '%')
                            ->orWhere('phone', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request['status'] != 'all', function ($query) use ($request) {
                $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })
            ->withCount([
                'bookings as ongoing_bookings_count' => function ($query) {
                    $query->where('booking_status', 'ongoing');
                },
                'bookings as completed_bookings_count' => function ($query) {
                    $query->where('booking_status', 'completed');
                },
                'bookings as canceled_bookings_count' => function ($query) {
                    $query->where('booking_status', 'canceled');
                }
            ])
            ->latest()->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        return response()->json(response_formatter(DEFAULT_200, $serviceman), 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'profile_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000',
            'identity_type' => 'required|in:passport,driving_license,company_id,nid,trade_license',
            'identity_number' => 'required',
            'identity_images' => 'required|array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        if ($this->serviceman->where('email', $request['email'])->exists()) {
            return response()->json(response_formatter(DEFAULT_400, null, [['error_code' => 'email', 'message' =>translate('Email already taken')]]), 400);
        }
        if ($this->serviceman->where('phone', $request['phone'])->exists()) {
            return response()->json(response_formatter(DEFAULT_400, null, [['error_code' => 'phone', 'message' =>translate('Phone already taken')]]), 400);
        }

        $identityImages = [];
        foreach ($request->identity_images as $image) {
            $imageName = file_uploader('provider/identity/', 'png', $image);
            $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
        }

        DB::transaction(function () use ($request, $identityImages) {
            $serviceman = $this->serviceman;
            $serviceman->module_id = $this->moduleId;
            $serviceman->service_provider_id = auth('provider')->user()->id;
            $serviceman->first_name = $request->first_name;
            $serviceman->last_name = $request->last_name;
            $serviceman->email = $request->email;
            $serviceman->phone = $request->phone;
            $serviceman->profile_image = file_uploader('provider/serviceman/', 'png', $request->file('profile_image'));
            $serviceman->identification_number = $request->identity_number;
            $serviceman->identification_type = $request->identity_type;
            $serviceman->identification_image = $identityImages;
            $serviceman->password = bcrypt($request->password);
            $serviceman->is_active = 1;
            $serviceman->is_approved = 1;
            $serviceman->save();
        });

        return response()->json(response_formatter(DEFAULT_STORE_200), 200);
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $bookings = Booking::where('serviceman_id', $id)
            ->select('booking_status', DB::raw('count(*) as total_booking'))
            ->groupBy('booking_status')
            ->get();

        $bookingCount = ['ongoing'=>0,'completed'=>0,'canceled'=>0];
        foreach ($bookings as $booking) {
            if ($booking->booking_status == 'ongoing')
                $bookingCount['ongoing'] = $booking->total_booking ?? 0;
            if ($booking->booking_status == 'completed')
                $bookingCount['completed'] = $booking->total_booking ?? 0;
            if ($booking->booking_status == 'canceled')
                $bookingCount['canceled'] = $booking->total_booking ?? 0;
        }

        $serviceman = $this->serviceman::find($id);
        $serviceman->bookings_count = $bookingCount;

        if (!isset($serviceman)) {
            return response()->json(response_formatter(DEFAULT_204), 204);
        }
        return response()->json(response_formatter(DEFAULT_200, $serviceman), 200);
    }

    /**
     * Show the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function edit(string $id): JsonResponse
    {
        $serviceman = $this->serviceman::where('id', $id)->first();

        if (!isset($serviceman)) {
            return response()->json(response_formatter(DEFAULT_204), 204);
        }
        return response()->json(response_formatter(DEFAULT_200, $serviceman), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $serviceman = $this->serviceman::where('id',$id)->first();

        if (!isset($serviceman)) {
            return response()->json(response_formatter(DEFAULT_204), 204);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'min:8',
            'profile_image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'identity_type' => 'in:passport,driving_license,company_id,nid,trade_license',
            'identity_number' => 'required',
            'identity_images' => 'array',
            'identity_images.*' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        if ($this->serviceman->where('email', $request['email'])->where('id', '!=', $serviceman->id)->exists()) {
            return response()->json(response_formatter(DEFAULT_400, null, [['error_code' => 'email', 'message' =>translate('Email already taken')]]), 400);
        }
        if ($this->serviceman->where('phone', $request['phone'])->where('id', '!=', $serviceman->id)->exists()) {
            return response()->json(response_formatter(DEFAULT_400, null, [['error_code' => 'phone', 'message' =>translate('Phone already taken')]]), 400);
        }

        $identityImages = [];
        if ($request->has('identity_images')) {
            foreach ($request['identity_images'] as $image) {
                $imageName = file_uploader('provider/identity/', 'png', $image);
                $identityImages[] = ['image'=>$imageName, 'storage'=> getDisk()];
            }
        }

        DB::transaction(function () use ($request, $identityImages, $serviceman) {
            $serviceman->first_name = $request->first_name;
            $serviceman->last_name = $request->last_name;
            $serviceman->email = $request->email;
            $serviceman->phone = $request->phone;
            if ($request->has('profile_image')) {
                $serviceman->profile_image = file_uploader('provider/serviceman/', 'png', $request->file('profile_image'));
            }
            $serviceman->identification_number = $request->identity_number;
            $serviceman->identification_type = $request->identity_type;
            if(count($identityImages) > 0) {
                $serviceman->identification_image = $identityImages;
            }
            if ($request->has('password')) {
                $serviceman->password = bcrypt($request->password);
            }
            $serviceman->save();
        });

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'serviceman_id' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicemen = $this->serviceman
            ->whereIn('id', $request->serviceman_id)
            ->get();

        if ($servicemen->isEmpty()) {
            return response()->json(response_formatter(DEFAULT_204), 200);
        }

        foreach ($servicemen as $serviceman) {
            if ($serviceman?->profile_image) {
                file_remover('provider/serviceman/', $serviceman->profile_image);
            }

            if (is_array($serviceman->identification_image)) {
                foreach ($serviceman->identification_image as $image) {
                    if (is_array($image) && isset($image['image'])) {
                        file_remover('provider/identity/', $image['image']);
                    }
                }
            }

            $serviceman->delete();
        }


        return response()->json(response_formatter(DEFAULT_DELETE_200), 200);
    }

    /**
     * * Bulk status update
     * @param Request $request
     * @return JsonResponse
     */
    public function changeActiveStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'serviceman_id' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $servicemen = $this->serviceman
            ->whereIn('id', $request->serviceman_id)
            ->get();

        if ($servicemen->isEmpty()) {
            return response()->json(response_formatter(DEFAULT_204), 200);
        }

        foreach ($servicemen as $serviceman) {
            $serviceman->is_active = !$serviceman->is_active;
            $serviceman->save();
        }

        return response()->json(response_formatter(DEFAULT_200), 200);
    }
}
