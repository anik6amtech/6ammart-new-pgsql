<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ServiceManagement;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ServiceManagement\Faq;
use App\Models\Module;

class FAQController extends Controller
{
    private $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }


    private function currentModule() {
        return config('module.current_module_data') ?? Module::where('module_type','service')->first();
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
            'service_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        $faq = $this->faq->latest()
            ->where('module_id', $this->currentModule()?->id)
            ->when($request->has('service_id'), function ($query) use ($request) {
                return $query->where('service_id', $request->service_id);
            })
            ->ofStatus(1)
            ->paginate($request['limit'], ['*'], 'offset', $request['offset'])->withPath('');

        return response()->json(response_formatter(DEFAULT_200, $faq), 200);
    }
}
