<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Update the value to the desired default redirect route

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authenticated request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if the authenticated user's email matches the admin email
        $adminEmail = 'admin@gmail.com'; // Replace with your admin email
        if ($user->email === $adminEmail) {
            // Redirect to the admin page
            return redirect()->route('admin.dashboard'); // Replace with your admin route or URL
        }

        // Redirect to the default redirect route
        return redirect()->intended($this->redirectPath());
    }
}
