<?php

namespace Modules\RideShare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\RideShare\Interface\BaseServiceInterface;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $baseService;
    public function __construct(BaseServiceInterface $baseService){
        $this->baseService = $baseService;
    }
}
