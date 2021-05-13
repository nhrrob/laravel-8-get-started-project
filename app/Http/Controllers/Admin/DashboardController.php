<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:dashboard view")->only('index');
    }
    
    public function index()
    {
        $data['products'] = User::latest()->get();
        return view('admin.dashboard.index', $data);
    }
}
