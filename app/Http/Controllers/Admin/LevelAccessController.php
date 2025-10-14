<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LevelAccessController extends Controller
{
    public function create()
    {

        return view('admin-views.rider-vehicle-management.vehicle.create');
    }
}
