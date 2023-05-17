<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }
}
