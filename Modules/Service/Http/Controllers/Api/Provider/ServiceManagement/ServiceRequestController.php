<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ServiceManagement;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ServiceManagement\ServiceRequest;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'string' => '',
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'status' => 'required|in:all,pending,accepted,denied'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $requests = ServiceRequest::with(['category'])
            ->where('user_id', $request->user('provider')->id)
            ->where('type', PROVIDER)
            ->when($request->has('string'), function ($query) use ($request) {
                $keys = explode(' ', base64_decode($request['string']));
                return $query->whereHas('category', function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->where('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request['status'] != 'all', function ($query) use ($request) {
                return $query->ofStatus($request['status']);
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        if ($requests->count() > 0) {
            return response()->json(response_formatter(DEFAULT_200, $requests), 200);
        }
        return response()->json(response_formatter(DEFAULT_204, $requests), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function makeRequest(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'nullable',
            'service_name' => 'required|max:255',
            'service_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        ServiceRequest::create([
            'category_id' => strtolower($request['category_id']) == 'null' || $request['category_id'] == '' ? null : $request['category_id'],
            'service_name' => $request['service_name'],
            'service_description' => $request['service_description'],
            'status' => 'pending',
            'user_id' => $request->user('provider')->id,
            'module_id' => $request->user('provider')->module_id,
            'type' => PROVIDER
        ]);

        return response()->json(response_formatter(DEFAULT_STORE_200), 200);
    }
}
