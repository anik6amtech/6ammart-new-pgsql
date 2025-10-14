<?php

namespace Modules\Service\Http\Controllers\Web\Provider;

use App\Models\Item;
use App\Models\AddOn;
use App\Models\Order;
use App\Models\Store;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Review;
use App\Models\Expense;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\DeliveryMan;
use App\Models\TempProduct;
use Illuminate\Support\Str;
use App\Models\EmployeeRole;
use App\Models\ItemCampaign;
use App\Models\RecentSearch;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\FlashSaleItem;
use App\CentralLogics\Helpers;
use App\Models\VendorEmployee;
use App\Models\WithdrawRequest;
use App\Models\StoreSubscription;
use Illuminate\Http\JsonResponse;
use App\Models\AccountTransaction;
use Modules\Rental\Entities\Trips;
use App\Models\DisbursementDetails;
use App\Http\Controllers\Controller;
use Modules\Rental\Entities\Vehicle;
use Illuminate\Support\Facades\Route;
use App\Models\SubscriptionTransaction;
use Modules\Rental\Entities\VehicleBrand;
use Modules\Rental\Entities\VehicleDriver;
use Modules\Rental\Entities\VehicleReview;
use App\Models\DisbursementWithdrawalMethod;
use Modules\Rental\Entities\VehicleCategory;
use App\Models\SubscriptionBillingAndRefundHistory;
use Modules\Service\Entities\BidModule\Post;
use Modules\Service\Entities\BookingModule\Booking;
use Modules\Service\Entities\EmployeeManagement\ProviderEmployee;
use Modules\Service\Entities\EmployeeManagement\ProviderRole;
use Modules\Service\Entities\ProviderManagement\Serviceman;
use Modules\Service\Entities\ServiceManagement\Service;

class SearchRoutingController extends Controller
{
    public function index(Request $request)
    {
        $provider_data = Helpers::get_provider_data();
        $vendor_id = $provider_data->vendor_id;
        $provider_id =  $provider_data->id;
        $moduleType = 'service';
        $module_id = $provider_data->module_id;
        $searchKeyword = $request->input('search');
        $userType = auth('provider')->check() ? 'provider' : 'provider-employee';

        session(['search_keyword' => $searchKeyword]);

        //1st layer
        $formattedRoutes = [];
        $jsonFilePath = public_path('provider_formatted_routes.json');
        if (file_exists($jsonFilePath)) {
            $fileContents = file_get_contents($jsonFilePath);
            $routes = json_decode($fileContents, true);

//            if (!addon_published_status('Rental')) {
//                $routes = array_filter($routes, function ($route) {
//                    return $route['moduleType'] !== 'rental';
//                });
//            }
//


            foreach ($routes as $route) {
                $uri = $route['URI'];
                if (Str::contains(strtolower($route['keywords']), strtolower($searchKeyword))) {
                    $hasParameters = preg_match('/\{(.*?)\}/', $uri);

                    $fullURL = $this->routeFullUrl($uri);

                    if (!$hasParameters) {
                        if ($moduleType === $route['moduleType'] || $route['moduleType'] === null) {

                            $routeName = $route['routeName'];
                            $routeName = preg_replace('/(?<=[a-z])(?=[A-Z])/', ' ', $routeName);
                            $routeName = trim(preg_replace('/\s+/', ' ', $routeName));

                            $formattedRoutes[] = [
                                'routeName' => ucwords($routeName),
                                'URI' => $uri,
                                'fullRoute' => $fullURL,
                            ];
                        }
                    }
                }
            }
        }

        //2nd layer
        $routes = Route::getRoutes();
        $providerRoutes = collect($routes->getRoutesByMethod()['GET'])->filter(function ($route) {
            return str_starts_with($route->uri(), 'provider');
        });
        $validRoutes = [];
        if (is_numeric($searchKeyword) &&   $searchKeyword > 0) {

            //post & booking
            $post = Post::where('module_id' , $module_id)->find($searchKeyword);
            if ($post) {

                $postRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'provider/booking/post/details');
                });


                if (isset($postRoutes)) {
                    foreach ($postRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $post, route: $route, type: 'post', prefix: 'Customized Booking');
                    }
                }
            }

            //multiple post with customer id
            $posts = Post::with(['customer'])
                ->where('module_id' , $module_id)
                ->whereHas('customer', function ($query) use ($searchKeyword) {
                    $query->where('id', $searchKeyword);
                })
                ->get();

            if ($posts) {
                $postsRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'provider/booking/post/details');
                });
                if (isset($postsRoutes)) {
                    foreach ($posts as $post) {
                        foreach ($postsRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $post, route: $route, type: 'post', prefix: 'Customized Booking');
                        }
                    }
                }
            }

            $booking = Booking::where('module_id' , $module_id)->find($searchKeyword);
            if ($booking) {

                if ($booking->is_repeated == 0){
                    $bookingRoutes = $providerRoutes->filter(function ($route) {
                        return str_contains($route->uri(), 'provider/booking/details')  && !str_contains($route->uri(), 'post') && !str_contains($route->uri(), 'rebooking') && !str_contains($route->uri(), 'repeat-single-details');
                    });
                }else{
                    $bookingRoutes = $providerRoutes->filter(function ($route) {
                        return str_contains($route->uri(), 'provider/booking/repeat-details')  && !str_contains($route->uri(), 'post') && !str_contains($route->uri(), 'rebooking') && !str_contains($route->uri(), 'repeat-single-details');
                    });
                }


                if (isset($bookingRoutes)) {
                    foreach ($bookingRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $booking, route: $route, type: 'booking', prefix: 'Booking');
                    }
                }
            }

            //multiple post with customer id
            $bookings = Booking::with(['customer'])
                ->where('module_id' , $module_id)
                ->whereHas('customer', function ($query) use ($searchKeyword) {
                    $query->where('id', $searchKeyword);
                })
                ->get();

            if ($bookings) {
                foreach ($bookings as $booking)
                {
                    if ($booking->is_repeated == 0){
                        $bookingRoutes = $providerRoutes->filter(function ($route) {
                            return str_contains($route->uri(), 'provider/booking/details')  && !str_contains($route->uri(), 'post') && !str_contains($route->uri(), 'rebooking') && !str_contains($route->uri(), 'repeat-single-details');
                        });
                    }else{
                        $bookingRoutes = $providerRoutes->filter(function ($route) {
                            return str_contains($route->uri(), 'provider/booking/repeat-details')  && !str_contains($route->uri(), 'post') && !str_contains($route->uri(), 'rebooking') && !str_contains($route->uri(), 'repeat-single-details');
                        });
                    }
                    foreach ($bookingRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $booking, route: $route, type: 'booking', name: $booking->id, prefix: 'Booking');
                    }
                }
            }

            //serviceman
            $serviceman = Serviceman::where('service_provider_id', $provider_id)->find($searchKeyword);
            if ($serviceman) {
                $servicemanRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'serviceman')
                        && str_contains($route->uri(), 'edit') || str_contains($route->uri(), 'provider/serviceman/details');
                });
                if (isset($servicemanRoutes)) {
                    foreach ($servicemanRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $serviceman, route: $route, type: 'serviceman', name: $serviceman->first_name . ' ' . $serviceman->last_name, prefix: 'Serviceman');
                    }
                }
            }

            //Advertisement
            $ads = Advertisement::where('store_id', $provider_id)->find($searchKeyword);
            if ($ads) {
                $adsRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'advertisement')
                        && (str_contains($route->uri(), 'edit') || str_contains($route->uri(), 'detail'));
                });
                if (isset($adsRoutes)) {
                    foreach ($adsRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $ads, route: $route, prefix: 'Advertisement');
                    }
                }
            }

            //store disbursement
            $storeDisbursement = DisbursementDetails::where('store_id', $provider_id)->where('disbursement_id', $searchKeyword)->first();
            if ($storeDisbursement) {
                $storeDisbursementRoutes = $providerRoutes->filter(function ($route) {
                    return (str_contains($route->uri(), 'disbursement-report') || str_contains($route->uri(), 'wallet/disbursement-list')) && !str_contains($route->uri(), 'disbursement-report-export');
                });

                if (isset($storeDisbursementRoutes)) {
                    foreach ($storeDisbursementRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $storeDisbursement, route: $route, name: $storeDisbursement->disbursement_id);
                    }
                }
            }




            //withdraw requests
            $withdrawRequest = WithdrawRequest::where('vendor_id', $vendor_id)->find($searchKeyword);
            if ($withdrawRequest) {
                $withdrawRequestRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'wallet') && !str_contains($route->uri(), 'disbursement-list')  && !str_contains($route->uri(), 'wallet-payment-list') && !str_contains($route->uri(), 'method-list') && !str_contains($route->uri(), 'export')  && !str_contains($route->uri(), 'subscription');
                });

                if (isset($withdrawRequestRoutes)) {
                    foreach ($withdrawRequestRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $withdrawRequest, route: $route, prefix: 'Withdraw Request');
                    }
                }
            }
            //Account transaction
            $accountTransaction = AccountTransaction::where('type', 'collected')
                ->where('created_by', 'store')
                ->where('from_id', $vendor_id)
                ->where('from_type', 'store')
                ->find($searchKeyword);
            if ($accountTransaction) {
                $accountTransactionRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'wallet-payment-list');
                });

                if (isset($accountTransactionRoutes)) {
                    foreach ($accountTransactionRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $accountTransaction, route: $route,);
                    }
                }
            }

            //withdraw method
            $withdrawalMethod = DisbursementWithdrawalMethod::where('store_id', $provider_id)->find($searchKeyword);
            if ($withdrawalMethod) {
                $withdrawalMethodRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'withdraw-method') && !str_contains($route->uri(), 'default');
                });

                if (isset($withdrawalMethodRoutes)) {
                    foreach ($withdrawalMethodRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $withdrawalMethod, route: $route, prefix: 'Withdraw Method');
                    }
                }
            }

            //Employee role
            $providerRole = ProviderRole::where('provider_id', $provider_id)->find($searchKeyword);
            if ($providerRole) {
                $providerRoleRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'provider/custom-role') && str_contains($route->uri(), 'edit');
                });

                if (isset($providerRoleRoutes)) {
                    foreach ($providerRoleRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $providerRole, route: $route, prefix: 'Employee Role', searchKeyword: $providerRole->name);
                    }
                }
            }

            //Employee
            $employee = ProviderEmployee::where('provider_id', $provider_id)->find($searchKeyword);
            if ($employee) {
                $employeeRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'provider/employee') && (str_contains($route->uri(), 'edit') || str_contains($route->uri(), 'details'));
                });

                if (isset($employeeRoutes)) {
                    foreach ($employeeRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $employee, route: $route, prefix: 'Employee', searchKeyword: $employee->f_name . ' ' . $employee->l_name);
                    }
                }
            }



            if ($provider_data->business_model !== 'commission') {
                //subscriber
                $storeSubscription = StoreSubscription::where('store_id', $provider_id)->where('store_type', 'service_provider')->find($searchKeyword);
                if ($storeSubscription) {
                    $storeSubscriptionRoutes = $providerRoutes->filter(function ($route) {
                        return str_contains($route->uri(), 'subscriber-detail');
                    });

                    if (isset($storeSubscriptionRoutes)) {
                        foreach ($storeSubscriptionRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $storeSubscription, route: $route, prefix: 'Subscription');
                        }
                    }
                }
                $SubscriptionTransaction = SubscriptionTransaction::where('store_id', $provider_id)->find($searchKeyword);
                if ($SubscriptionTransaction) {
                    $SubscriptionTransactionRoutes = $providerRoutes->filter(function ($route) {
                        return str_contains($route->uri(), 'subscriber-transactions');
                    });

                    if (isset($SubscriptionTransactionRoutes)) {
                        foreach ($SubscriptionTransactionRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $SubscriptionTransaction, type: 'subscriber-transactions', route: $route, searchKeyword: $SubscriptionTransaction->id);
                        }
                    }
                }


                //subscriber
                $storeSubscriptionBillingAndRefundHistory = SubscriptionBillingAndRefundHistory::where('store_id', $provider_id)->where('store_type', 'service_provider')->find($searchKeyword);
                if ($storeSubscriptionBillingAndRefundHistory) {
                    $storeSubscriptionBillingAndRefundHistoryRoutes = $providerRoutes->filter(function ($route) {
                        return str_contains($route->uri(), 'subscriber-wallet-transactions');
                    });

                    if (isset($storeSubscriptionBillingAndRefundHistoryRoutes)) {
                        foreach ($storeSubscriptionBillingAndRefundHistoryRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $storeSubscriptionBillingAndRefundHistory, route: $route, prefix: 'Subscription');
                        }
                    }
                }
            }
            //expense report
            $expense = Expense::where('store_id', $provider_id)->where('created_by', 'vendor')->find($searchKeyword);
            if ($expense) {
                $expenseRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'expense-report');
                });

                if (isset($expenseRoutes)) {
                    foreach ($expenseRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $expense, route: $route, prefix: null);
                    }
                }
            }

            if (in_array($moduleType, ['grocery', 'ecommerce'])) {
                //item
                $FlashSaleItem = FlashSaleItem::wherehas('item', function ($query) use ($provider_id) {
                    $query->where('store_id', $provider_id);
                })->find($searchKeyword);
                if ($FlashSaleItem) {
                    $itemRoutes = $providerRoutes->filter(function ($route) {
                        return (str_contains($route->uri(), 'item/flash-sale'));
                    });

                    if (isset($itemRoutes)) {
                        foreach ($itemRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $FlashSaleItem, route: $route, type: 'Flash Sale Item', prefix: 'FlashSale', name: $FlashSaleItem?->item?->name, searchKeyword: $FlashSaleItem?->item?->name);
                        }
                    }
                }
            }
        } else {

            $bookings = Booking::with('customer')->where(function ($query) use ($searchKeyword) {
                $query->where('booking_status', 'LIKE', '%' . $searchKeyword . '%' )
                    ->orwhere('payment_method', 'LIKE', '%' . $searchKeyword . '%' )
                    ->orwhereHas('customer', function ($query) use ($searchKeyword) {
                        $query->where('f_name', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('l_name', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('phone', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhereRaw("CONCAT(f_name, ' ', l_name) LIKE ?", ['%' . $searchKeyword . '%'])
                            ->orWhereRaw("CONCAT(f_name,l_name) LIKE ?", ['%' . $searchKeyword . '%'])
                            ->orWhereRaw("CONCAT(l_name,f_name) LIKE ?", ['%' . $searchKeyword . '%']);
                    });
            })->get();

            if ($bookings) {
                foreach ($bookings as $booking)
                {
                    if ($booking->is_repeated == 0){
                        $bookingRoutes = $providerRoutes->filter(function ($route) {
                            return str_contains($route->uri(), 'provider/booking/details')  && !str_contains($route->uri(), 'post') && !str_contains($route->uri(), 'rebooking') && !str_contains($route->uri(), 'repeat-single-details');
                        });
                    }else{
                        $bookingRoutes = $providerRoutes->filter(function ($route) {
                            return str_contains($route->uri(), 'provider/booking/repeat-details')  && !str_contains($route->uri(), 'post') && !str_contains($route->uri(), 'rebooking') && !str_contains($route->uri(), 'repeat-single-details');
                        });
                    }
                    foreach ($bookingRoutes as $route) {
                        $validRoutes[] = $this->filterRoute(model: $booking, route: $route, type: 'booking', name: $booking->id, prefix: 'Booking');
                    }
                }
            }



            //Advertisement
            $advertisements = Advertisement::where('store_id', $provider_id)
                ->where(function ($query) use ($searchKeyword) {
                    $query->where('title', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('add_type', 'LIKE', '%' . $searchKeyword . '%');
                })
                ->get();

            if ($advertisements) {
                $adsRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'advertisement')
                        && (str_contains($route->uri(), 'edit') || str_contains($route->uri(), 'detail'));
                });
                if (isset($adsRoutes)) {
                    foreach ($advertisements as $advertisement) {
                        foreach ($adsRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $advertisement, route: $route, prefix: 'Advertisement');
                        }
                    }
                }
            }

            //vendor Role
            $vendorRoles = ProviderRole::where('provider_id', $provider_id)
                ->where(function ($query) use ($searchKeyword) {
                    $query->where('name', 'LIKE', '%' . $searchKeyword . '%');
                })
                ->get();

            if ($vendorRoles) {
                $vendorRoleRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'custom-role/list') && !str_contains($route->uri(), 'edit');
                });

                if (isset($vendorRoleRoutes)) {
                    foreach ($vendorRoles as $vendorRole) {
                        foreach ($vendorRoleRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $vendorRole, route: $route, prefix: 'Employee Role', searchKeyword: $vendorRole->name);
                        }
                    }
                }
            }

            $vendorEmployee = ProviderEmployee::where('provider_id', $provider_id)
                ->where(function ($query) use ($searchKeyword) {
                    $query->where('f_name', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('l_name', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('phone', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchKeyword . '%');
                })
                ->get();

            if ($vendorEmployee) {
                $adminRoleRoutes = $providerRoutes->filter(function ($route) {
                    return str_contains($route->uri(), 'employee/list') && !str_contains($route->uri(), 'update') && !str_contains($route->uri(), 'export');
                });

                if (isset($adminRoleRoutes)) {
                    foreach ($vendorEmployee as $employee) {
                        foreach ($adminRoleRoutes as $route) {
                            $validRoutes[] = $this->filterRoute(model: $employee, route: $route, prefix: 'Employee', searchKeyword: $employee->f_name . ' ' . $employee->l_name);
                        }
                    }
                }
            }
        }

        $result = array_merge($formattedRoutes, $validRoutes);
        $result = collect($result);
        $result = $result->unique('fullRoute')->values()->all();
        return $this->sortBySearchKeyword($result, $searchKeyword);
    }

    private function routeFullUrl($uri)
    {
        return url($uri);
    }

    private function filterRoute($model, $route, $type = null, $name = null, $prefix = null, $searchKeyword = null): array
    {
        $uri = $route->uri();
        $routeName = $route->getName();
        $formattedRouteName = ucwords(str_replace(['.', '_'], ' ', Str::afterLast($routeName, '.')));

        preg_match_all('/\{(\w+\??)\}/', $uri, $matches);
        $placeholders = $matches[1];

        $uriWithParameter = $uri;

        if (!empty($placeholders)) {
            $firstPlaceholder = $placeholders[0];
            $uriWithParameter = str_replace("{{$firstPlaceholder}}", $model->id, $uriWithParameter);
        }

        $uriWithParameter = preg_replace('/\{\w+\?\}/', '', $uriWithParameter);
        $uriWithParameter = preg_replace('/\/+/', '/', $uriWithParameter);
        $uriWithParameter = rtrim($uriWithParameter, '/');


        if ($searchKeyword && (!is_numeric($searchKeyword) || in_array($type, ['subscriber-transactions', 'order', 'trip', 'Vehicle_Review']))) {
            $uriWithParameter .= '?search=' . urlencode($searchKeyword);
        }

        $fullURL = url('/') . '/' . $uriWithParameter;

        if ($type == 'booking'){
            $fullURL = url('/') . '/' . $uriWithParameter. '?web_page=details';
        }
        if ($type == 'customer'){
            $fullURL = $formattedRouteName == 'Detail' ? $fullURL. '?web_page=overview' : $fullURL;
        }

        $routeName = $prefix ? $prefix . ' ' . $formattedRouteName : $formattedRouteName;
        $routeName = $name ? $routeName . ' - (' . $name . ')' : $routeName;
        $routeName = preg_replace('/(?<=[a-z])(?=[A-Z])/', ' ', $routeName);
        $routeName = trim(preg_replace('/\s+/', ' ', $routeName));

        return [
            'routeName' => $routeName,
            'URI' => $uriWithParameter,
            'fullRoute' => $fullURL,
        ];
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function providerClickedRoute(Request $request): JsonResponse
    {
        $userId = Helpers::get_vendor_id();
        $userType = auth('vendor')->check() ? 'vendor' : 'vendor-employee';
        $routeName = $request->input('routeName');
        $routeUri = $request->input('routeUri');
        $routeFullUrl = $request->input('routeFullUrl');
        $searchKeyword = $request->input('searchKeyword');

        $existingClick = RecentSearch::where('user_id', $userId)
            ->where('user_type', $userType)
            ->where('route_uri', $routeUri)
            ->first();

        if (!$existingClick) {
            $clickedRoute = new RecentSearch();
            $clickedRoute->user_id = $userId;
            $clickedRoute->user_type = $userType;
            $clickedRoute->route_name = $routeName;
            $clickedRoute->route_uri = $routeUri;
            $clickedRoute->module_id = Helpers::get_store_data()->module_id;
            $clickedRoute->keyword = $searchKeyword;
            $clickedRoute->route_full_url = isset($searchKeyword) ? $routeFullUrl . '?keyword=' . $searchKeyword : $routeFullUrl;
            $clickedRoute->save();
        } else {
            $existingClick->created_at = now();
            $existingClick->update();
        }

        $userClicksCount = RecentSearch::where('user_id', $userId)
            ->where('user_type', $userType)
            ->count();

        if ($userClicksCount > 15) {
            RecentSearch::where('user_id', $userId)
                ->where('user_type', $userType)
                ->orderBy('created_at', 'asc')
                ->first()
                ->delete();
        }

        return response()->json(['message' => 'Clicked route stored successfully']);
    }

    public function recentSearch(): JsonResponse
    {
        $userId = Helpers::get_vendor_id();
        $userType = auth('vendor')->check() ? 'vendor' : 'vendor-employee';

        $recentSearches = RecentSearch::where('user_id', $userId)
            ->where('user_type', $userType)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($recentSearches);
    }

    private function sortBySearchKeyword(array $routes, string $keyword): array
    {
        usort($routes, function ($a, $b) use ($keyword) {
            $aMatch = min(
                $this->strposIgnoreCase($a['routeName'], $keyword),
                $this->strposIgnoreCase($a['URI'], $keyword),
                $this->strposIgnoreCase($a['fullRoute'], $keyword)
            );
            $bMatch = min(
                $this->strposIgnoreCase($b['routeName'], $keyword),
                $this->strposIgnoreCase($b['URI'], $keyword),
                $this->strposIgnoreCase($b['fullRoute'], $keyword)
            );

            return $aMatch <=> $bMatch;
        });

        return $routes;
    }

    private function strposIgnoreCase($haystack, $needle)
    {
        $pos = stripos($haystack, $needle);
        return $pos === false ? PHP_INT_MAX : $pos;
    }
}
