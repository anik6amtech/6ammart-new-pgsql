<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class DashboardController extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|JsonResponse
     */
    public function dashboard(Request $request): Application|Factory|View|RedirectResponse|JsonResponse
    {

        $module_type = Config::get('module.current_module_type');
        if ($module_type == 'settings') {
            return redirect()->route('admin.business-settings.business-setup');
        }

        return view("ride-share::admin.dashboard-{$module_type}");
    }

}
