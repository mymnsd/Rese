<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }
}
