<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        // Process the admin users and return a response
        // ...
    }
}
