<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){

        Gate::authorize('dashboard.view');
        return view('admin.dashboard');
    }
}
