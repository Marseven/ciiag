<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BasicController
{
    //
    public function dashboard()
    {
        return view('admin.dashboard');
    }


}
