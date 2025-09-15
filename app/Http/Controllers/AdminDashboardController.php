<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class AdminDashboardController extends Controller
{
    public function index(){
        
        return view('admin.dashboard');
    }
}
