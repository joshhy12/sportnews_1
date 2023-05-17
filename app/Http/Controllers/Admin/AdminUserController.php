<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;


class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'role' => 'required|in:admin,user',
    ]);

    $user = new User([
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password' => bcrypt($request->get('password')),
        'role' => $request->get('role'),
    ]);

    $user->save();
    return redirect('/admin/users')->with('success', 'User has been added successfully');
}


    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'nullable|min:8'
    ]);

    $user = User::find($id);
    $user->name = $request->get('name');
    $user->email = $request->get('email');
    if ($request->filled('password')) {
        $user->password = bcrypt($request->get('password'));
    }
    $user->save();

    return redirect('/admin/users')->with('success', 'User has been updated successfully');
}

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User has been deleted successfully');
    }
}
