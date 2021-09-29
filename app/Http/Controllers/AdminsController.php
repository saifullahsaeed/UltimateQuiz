<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminsController extends Controller
{
    /**
     * Display admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function admins()
    {
        $admins = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admins')->with('admins',$admins);
    }

    /**
     * Create New Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAdmin(Request $request)
    {
        if ($request->password == $request->password_confirmation) {
        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'admin' => $request->admin,
        'password' => Hash::make($request->password),
        ]);
        Session::flash('success', 'New Admin created successfully!');
        return redirect()->back();
        } else {
        Session::flash('error', 'Passwords are not identical!');
        return redirect()->back(); 
        }

    }

    /**
     * Delete Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin(User $admin)
    {
        $admin->delete();
        Session::flash('success', 'This Admin had been deleted successfully!');
        return redirect()->back();
    }
}
