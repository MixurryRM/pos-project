<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //direct to admin dashboard
    public function adminDashboard(){
        return view('admin.home.index');
    }
}
