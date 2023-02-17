<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show admin panel
    public function manage_admin() {
        return view('admin.manage');
    }
}
