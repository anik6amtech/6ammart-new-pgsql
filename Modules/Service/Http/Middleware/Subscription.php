<?php

namespace Modules\Service\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\CentralLogics\Helpers;
use Brian2694\Toastr\Facades\Toastr;

class Subscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$module): Response
    {
        if (auth('provider_employee')->check() || auth('provider')->check()) {
            $provider = Helpers::get_provider_data();
            if($provider->business_model== 'commission'){
                return $next($request);
            }
            elseif($provider->business_model == 'unsubscribed') {
                Toastr::error(translate('messages.your_subscription_is_expired.You_can_only_process_your_on_going_orders.'));
                return back();
            }
            elseif($provider->business_model == 'none') {
                Toastr::error(translate('Please_chose_a_business_plan_to_continue_your_services'));
                return back();
            }
            elseif($provider->business_model == 'subscription') {
                    if($provider->store_sub == null){
                        Toastr::error(translate('messages.you_are_not_subscribed_to_any_package'));
                        return back();
                    } else {
                    $provider_sub = $provider?->store_sub;

                    $modulePermissons = [
                        'reviews' => $provider_sub?->review,
                        'chat' => $provider_sub?->chat,
                        'scheduled_service' => $provider_sub?->scheduled_service,
                        'service_request' => $provider_sub?->service_request,
                        'advertisement' => $provider_sub?->advertisement,
                        'reports_and_analytics' => $provider_sub?->reports_and_analytics,
                        'bidding' => $provider_sub?->bidding,
                    ];
                    if (in_array($module,['reviews','chat','scheduled_service','service_request','advertisement','reports_and_analytics','bidding']) ) {
                        if ($modulePermissons[$module] == 1) {
                            return $next($request);
                        } else {
                            Toastr::error(translate('messages.your_package_does_not_include_this_section'));
                            return back();
                        }
                    }
                }
            }


        }
        return $next($request);
    }
}
