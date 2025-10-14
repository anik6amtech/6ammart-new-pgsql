<?php

namespace Modules\Service\Http\Controllers\Api\Customer\CategoryManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ServiceManagement\FavoriteService;
use Modules\Service\Entities\ServiceManagement\RecentView;
use App\Models\Module;

class CategoryController extends Controller
{

    private Category $category;
    private RecentView $recentView;
    private FavoriteService $favoriteService;
    private bool $is_customer_logged_in;
    private mixed $customer_user_id;

    public function __construct(Category $category, RecentView $recentView, FavoriteService $favoriteService, Request $request)
    {
        $this->category = $category;
        $this->recentView = $recentView;
        $this->favoriteService = $favoriteService;

        $this->is_customer_logged_in = (bool)auth('api')->user();
        $this->customer_user_id = $this->is_customer_logged_in ? auth('api')->user()->id : $request['guest_id'];
    }

    private function currentModule() {
        return config('module.current_module_data') ?? Module::where('module_type','service')->first();
    }

    private function zoneId() {
        return Config::get('zone_id');
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
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $categories = $this->category->ofStatus(1)->ofType('main')
            ->with(['zones','children' => function ($q) {
                $q->withoutGlobalScopes();
            }])
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        return response()->json(response_formatter(DEFAULT_200, $categories), 200);
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function childes(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $childes = $this->category->ofStatus(1)->ofType('sub')
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->withoutGlobalScopes(['zone_wise_data'])
            ->withCount(['services' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->whereHas('parent', function ($query) {
                $query->ofStatus(1);
            })
            ->where('parent_id', $request['id'])->orderBY('name', 'asc')
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        if (count($childes) > 0) {
            $authUser = auth('api')->user();
            if ($authUser) {
                $recentView = $this->recentView->firstOrNew(['category_id' => $request->id, 'user_id' => $authUser->id]);
                $recentView->total_category_view += 1;
                $recentView->save();
            }

            return response()->json(response_formatter(DEFAULT_200, $childes), 200);
        }

        return response()->json(response_formatter(DEFAULT_204), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function subCategoryList(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }


        $subCategories = $this->category
            ->withoutGlobalScope('zone_wise_data')
            ->withCount('services')
            ->with(['parent'])
            ->ofStatus(1)
            ->ofType('sub')
            ->whereHas('parent', function ($query) {
                $query->ofStatus(1)
                    ->whereHas('zones', function ($query) {
                        $query->where('zone_id', $this->zoneId());
                    });
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        return response()->json(response_formatter(DEFAULT_200, $subCategories), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function featured(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|numeric|min:1|max:200',
            'offset' => 'required|numeric|min:1|max:100000'
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $categories = $this->category
            ->with(['zones', 'services_by_category.variations', 'services_by_category' => function ($query) {
                $query->ofStatus(1)
                    ->where(function ($query) {
                        $query->whereDoesntHave('service_discount')
                            ->orWhereHas('service_discount');
                    })
                    ->where(function ($query) {
                        $query->whereDoesntHave('category.category_discount')
                            ->orWhereHas('category.category_discount');
                    })
                    ->with(['variations', 'service_discount', 'category.category_discount']);
            }])
            ->ofStatus(1)
            ->ofFeatured(1)
            ->ofType('main')
            ->when($this->currentModule(), function($query){
                $query->module($this->currentModule()->id);
            })
            ->latest()
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        foreach ($categories as $category) {
            $category->services_by_category = self::variationMapper($category->services_by_category);
        }

        return response()->json(response_formatter(DEFAULT_200, $categories), 200);
    }

    private function variationMapper($services)
    {
        $services->map(function ($service) {
            $service['is_favorite'] = $this->favoriteService->where('customer_user_id',$this->customer_user_id)->where('service_id',$service->id)->exists() ? 1 : 0;
            $service['variations_app_format'] = self::variationsAppFormat($service);
            return $service;
        });
        return $services;
    }

    private function variationsAppFormat($service): array
    {
        $formatting = [];
        $filtered = $service['variations']->where('zone_id', Config::get('zone_id'));
        $formatting['zone_id'] = Config::get('zone_id');
        $formatting['default_price'] = $filtered->first() ? $filtered->first()->price : 0;
        foreach ($filtered as $data) {
            $formatting['zone_wise_variations'][] = [
                'variant_key' => $data['variant_key'],
                'variant_name' => $data['variant'],
                'price' => $data['price']
            ];
        }
        return $formatting;
    }

}
