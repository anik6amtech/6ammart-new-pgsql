<?php

namespace Modules\Service\Http\Controllers\Web\Admin\ServiceManagement;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\Service\Entities\ServiceManagement\Faq;

class FAQController extends Controller
{

    private $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {

    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $service_id
     * @return JsonResponse
     */
    public function store(Request $request, $service_id): JsonResponse
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = $this->faq;
        $faq->module_id = $this->currentModuleId();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->service_id = $service_id;
        $faq->is_active = 1;
        $faq->save();

        $faqs = $this->faq->latest()->where('service_id', $service_id)->get();
        $webPage = 'faq';

        return response()->json(['flag' => 1, 'template' => view('service::admin.service-management.partials._faq-list', compact('faqs','webPage'))->render()]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $service_id, $id): JsonResponse
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = $this->faq->find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = 1;
        $faq->save();

        $faqs = $this->faq->latest()->where('service_id', $faq->service_id)->get();

        return response()->json(['flag' => 1, 'template' => view('service::admin.service-management.partials._faq-list', compact('faqs'))->render()]);
    }


    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $faq_id
     * @param $service_id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $service_id, $id): RedirectResponse
    {
        $this->faq->where(['id' => $id])->delete();
        $faqs = $this->faq->latest()->where('service_id', $service_id)->get();

        Toastr::success(translate('FAQ deleted successfully'));
        return redirect()->back();
        // return response()->json(['flag' => 1, 'template' => view('service::admin.service-management.partials._faq-list', compact('faqs'))->render()]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function statusUpdate(Request $request, $service_id, $id): RedirectResponse
    {
        $this->faq->where('id', $id)->update(['is_active' => !$this->faq->where('id', $id)->first()->is_active]);
        Toastr::success(translate('FAQ status updated successfully'));
        return redirect()->back();
    }
}
