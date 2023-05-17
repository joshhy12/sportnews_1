<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Models\User;
use App\Models\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        return redirect()->route('admin.index');
    }

    return redirect('/');
}


    // Your code here
}
