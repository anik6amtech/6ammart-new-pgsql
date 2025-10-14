<?php

namespace Modules\Service\Http\Controllers\Web\Provider\PromotionManagement;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Rules\WordValidation;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Service\Http\Requests\Provider\PromotionManagement\AdvertisementStoreRequest;
use Modules\Service\Http\Requests\Provider\PromotionManagement\AdvertisementUpdateRequest;

class AdvertisementController extends Controller
{
    private function currentModuleId(): int
    {
        return Helpers::get_provider_data()->module_id ?? 0;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $key = explode(' ', $request['search']);
        $adds=Advertisement::where('store_id', Helpers::get_provider_id())
            ->when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            // ->whereNotIn('status' ,['pending','denied' ])
            // ->when($request?->ads_type === 'running',function($query){
            //     $query->valid();
            // })
            // ->when($request?->ads_type === 'approved',function($query){
            //     $query->approved();
            // })
            // ->when($request?->ads_type === 'expired',function($query){
            //     $query->expired();
            // })
            // ->when($request?->ads_type === 'paused',function($query){
            //     $query->where('status','paused');
            // })
            ->when($request?->search ,function($query)use($key) {
                foreach ($key as $value) {
                $query->where(function($query) use ($value){
                        $query->where('id', 'like', "%{$value}%")->orWhereHas('store',function($query)use ($value){
                            $query->where('name', 'like', "%{$value}%");
                        });
                    });
                };
            })
            ->orderByRaw('ISNULL(priority), priority ASC')
            ->paginate(config('default_pagination'));


        $total_adds = Advertisement::whereNotNull('priority')
            ->where('store_id', Helpers::get_provider_id())
            ->when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            ->count() + 1;
        $ads_count= Advertisement::when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            ->where('store_id', Helpers::get_provider_id())
            ->count();


        return view("service::provider.promotion-management.advertisement.list",compact('adds','total_adds','ads_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language = getWebConfig('language');
        $defaultLang = str_replace('_', '-', app()->getLocale());
        $total_adds=Advertisement::whereNotNull('priority')
            ->where('store_id', Helpers::get_provider_id())
            ->when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            ->count()+1;
        return view("service::provider.promotion-management.advertisement.create",compact('total_adds','defaultLang','language'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AdvertisementStoreRequest $request)
    {
        $dateRange = $request->dates;
        list($startDate, $endDate) = explode(' - ', $dateRange);
        $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDate));
        $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDate));
        $startDate = $startDate->startOfDay();
        $endDate = $endDate->endOfDay();


        
        $advertisement = New Advertisement();
        $advertisement->store_id = Helpers::get_provider_id();
        $advertisement->add_type = $request->advertisement_type;
        $advertisement->title = $request->title[array_search('default', $request->lang)];
        $advertisement->description = $request->description[array_search('default', $request->lang)];
        $advertisement->start_date = $startDate;
        $advertisement->end_date = $endDate;
        $advertisement->is_rating_active = $request->advertisement_type == 'store_promotion' ?  $request?->rating ?? 0 : 0;
        $advertisement->is_review_active = $request->advertisement_type == 'store_promotion' ?  $request?->review ?? 0 : 0;
        $advertisement->is_paid = 0;
        $advertisement->created_by_id = Helpers::get_provider_id();
        $advertisement->created_by_type = 'Modules\Service\Entities\ProviderManagement\Provider';
        $advertisement->status = 'pending';

        $advertisement->cover_image = $request->has('cover_image') &&  $request->advertisement_type == 'store_promotion' ?  Helpers::upload(dir: 'advertisement/', format:$request->file('cover_image')->getClientOriginalExtension(), image:$request->file('cover_image')) : null;
        $advertisement->profile_image = $request->has('profile_image') &&  $request->advertisement_type == 'store_promotion' ?  Helpers::upload(dir: 'advertisement/', format:$request->file('profile_image')->getClientOriginalExtension(), image:$request->file('profile_image')) : null;
        $advertisement->video_attachment = $request->has('video_attachment') &&  $request->advertisement_type == 'video_promotion' ?  Helpers::upload(dir: 'advertisement/', format:$request->file('video_attachment')->getClientOriginalExtension(), image:$request->file('video_attachment')) : null;
        $advertisement->module_id = $this->currentModuleId();
        $advertisement->module_type = 'service';
        $advertisement->save();

        Helpers::add_or_update_translations(request: $request, key_data:'title' , name_field:'title' , model_name: 'Advertisement' ,data_id: $advertisement->id,data_value: $advertisement->title);

        Helpers::add_or_update_translations(request: $request, key_data:'description' , name_field:'description' , model_name: 'Advertisement' ,data_id: $advertisement->id,data_value: $advertisement->description);

        return response()->json(['type'=> 'provider' ,'message'=>translate('messages.Advertisement_Added_Successfully') ], 200);

    }


    /**
     * Display the specified resource.
     */
    public function show($advertisement,Request $request)
    {
        $request_page_type=$request?->request_page_type ?? null;
        $nextId = Advertisement::where('id', '>', $advertisement)
            ->where('store_id', Helpers::get_provider_id())
            ->when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            ->when($request_page_type == 'update-requests' , function($query){
                $query->where('is_updated',1)->whereNotIn('status' ,['pending']);
            })
            ->when($request_page_type == 'denied-requests' , function($query){
                $query->whereIn('status' ,['denied']);
            })
            ->when($request_page_type == 'pending-requests' , function($query){
                $query->where('is_updated',0)->whereIn('status' ,['pending']);
            })
            ->min('id');

        $previousId = Advertisement::where('id', '<', $advertisement)
            ->where('store_id', Helpers::get_provider_id())
            ->when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            ->when($request_page_type == 'update-requests' , function($query){
                $query->where('is_updated',1)->whereNotIn('status' ,['pending']);
            })
            ->when($request_page_type == 'denied-requests' , function($query){
                $query->whereIn('status' ,['denied']);
            })
            ->when($request_page_type == 'pending-requests' , function($query){
                $query->where('is_updated',0)->whereIn('status' ,['pending']);
            })
            ->max('id');
        $language = getWebConfig('language');
        $defaultLang = str_replace('_', '-', app()->getLocale());

        $advertisement= Advertisement::where('id',$advertisement)
            ->where('store_id', Helpers::get_provider_id())
            ->withoutGlobalScope('translate')
            ->with('translations')
            ->firstOrFail();
        return view("service::provider.promotion-management.advertisement.details",compact('advertisement','nextId','previousId','request_page_type','language','defaultLang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Advertisement $advertisement)
    {
        $language = getWebConfig('language');
        $defaultLang = str_replace('_', '-', app()->getLocale());
        $request_page_type=$request?->request_page_type ;
        $advertisement->withoutGlobalScope('translate');
        $advertisement->load('translations');
        $total_adds = Advertisement::whereNotNull('priority')
            ->where('store_id', Helpers::get_provider_id())
            ->when(is_numeric($this->currentModuleId()), function($query){
                $query->where('module_id', $this->currentModuleId());
            })
            ->count()+1;
        return view("service::provider.promotion-management.advertisement.edit",compact('advertisement','total_adds','request_page_type','language','defaultLang'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertisementUpdateRequest $request, Advertisement $advertisement)
    {
        $dateRange = $request->dates;
        list($startDate, $endDate) = explode(' - ', $dateRange);
        $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDate));
        $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDate));
        $startDate = $startDate->startOfDay();
        $endDate = $endDate->endOfDay();


        if( $advertisement->add_type != $request->advertisement_type){

            if($request->advertisement_type == 'video_promotion' &&  !$request->has('video_attachment')){
                return response([ 'file_required' => 1 , 'message' => translate('You_must_need_to_add_a_promotional_video_file')], 200);
            }

            if($request->advertisement_type == 'store_promotion' &&  (!$request->has('cover_image') || !$request->has('profile_image'))  ){
                return response([ 'file_required' => 1 , 'message' => translate('You_must_need_to_add_cover_&_profile_image')], 200);
            }

            if($advertisement->cover_image && $request->advertisement_type == 'video_promotion')
            {
                Helpers::check_and_delete('advertisement/' , $advertisement->cover_image);
            }
            if($advertisement->profile_image && $request->advertisement_type == 'video_promotion')
            {
                Helpers::check_and_delete('advertisement/' , $advertisement->profile_image);
            }


            if($advertisement->video_attachment && $request->advertisement_type == 'store_promotion')
            {
                Helpers::check_and_delete('advertisement/' , $advertisement->video_attachment);
            }
        }

        $advertisement->store_id = Helpers::get_provider_id();
        $advertisement->title = $request->title[array_search('default', $request->lang)];
        $advertisement->description = $request->description[array_search('default', $request->lang)];
        $advertisement->start_date = $startDate;
        $advertisement->end_date = $endDate;
        $advertisement->is_rating_active = $request->advertisement_type == 'store_promotion' ?  ($request?->rating ?? 0) : 0;
        $advertisement->is_review_active = $request->advertisement_type == 'store_promotion' ?  ($request?->review ?? 0) : 0;

        $advertisement->is_updated = $advertisement->status == 'pending' ? 0 : 1;
        $advertisement->status = 'pending';
        // $advertisement->status = 'approved';

        $advertisement->add_type = $request->advertisement_type;
        $advertisement->cover_image = $request->has('cover_image') &&  $request->advertisement_type == 'store_promotion' ? Helpers::update(dir:'advertisement/', old_image: $advertisement->cover_image, format:$request->file('cover_image')->getClientOriginalExtension(), image: $request->file('cover_image')) : $advertisement->cover_image;
        $advertisement->profile_image = $request->has('profile_image') &&  $request->advertisement_type == 'store_promotion' ? Helpers::update(dir:'advertisement/', old_image: $advertisement->profile_image, format:$request->file('profile_image')->getClientOriginalExtension(), image: $request->file('profile_image')) : $advertisement->profile_image;
        $advertisement->video_attachment = $request->has('video_attachment') &&  $request->advertisement_type == 'video_promotion' ? Helpers::update(dir:'advertisement/', old_image: $advertisement->video_attachment, format:$request->file('video_attachment')->getClientOriginalExtension(), image: $request->file('video_attachment')) : $advertisement->video_attachment;

        $advertisement->save();

        Helpers::add_or_update_translations(request: $request, key_data:'title' , name_field:'title' , model_name: 'Advertisement' ,data_id: $advertisement->id,data_value: $advertisement->title);
        Helpers::add_or_update_translations(request: $request, key_data:'description' , name_field:'description' , model_name: 'Advertisement' ,data_id: $advertisement->id,data_value: $advertisement->description);

        return response()->json(['message' => translate('messages.Advertisement_Updated_Successfully')], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advertisement =Advertisement::where('id',$id)
            ->where('store_id', Helpers::get_provider_id())
            ->first();

        if($advertisement?->cover_image)
        {
            Helpers::check_and_delete('advertisement/' , $advertisement->cover_image);
        }
        if($advertisement?->profile_image)
        {
            Helpers::check_and_delete('advertisement/' , $advertisement->profile_image);
        }
        if($advertisement?->video_attachment)
        {
            Helpers::check_and_delete('advertisement/' , $advertisement->video_attachment);
        }
        $advertisement?->translations()?->delete();
        $module_id =$advertisement?->module_id;
        $advertisement?->delete();

        $adds=Advertisement::whereNotNull('priority')
            ->where('store_id', Helpers::get_provider_id())
            ->where('module_id',$module_id)
            ->orderByRaw('ISNULL(priority), priority ASC')->get();

        $newPriority = 1;
        foreach ($adds as $advertisement) {
            $advertisement->priority = $newPriority++;
            $advertisement->save();
        }

        Toastr::success(translate('messages.Advertisement_deleted_successfully'));
        return back();
    }

    public function status(Request $request)
    {

        $request->validate([
            'pause_note' => ['required_if:status,paused', new WordValidation],
            'cancellation_note' => ['required_if:status,denied', new WordValidation],
        ]);

        $advertisement =Advertisement::where('id',$request->id)
            ->where('store_id', Helpers::get_provider_id())
            ->with('store')->first();
            
        $advertisement->status = in_array($request->status,['paused', 'approved']) ? $request->status : $advertisement->status; //['paused','approved','denied']
        $advertisement->pause_note = $request?->pause_note ?? null;
        $advertisement->cancellation_note = $request?->cancellation_note ?? null;
        $advertisement->is_updated =0;
        $advertisement?->save();
        
        Toastr::success(translate('messages.Advertisement_status_updated_successfully'));
        return back();
    }
}
