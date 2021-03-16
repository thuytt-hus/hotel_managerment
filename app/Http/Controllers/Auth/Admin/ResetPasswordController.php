<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * ResetPasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.auth.changepassword');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. 
                                        Please try again.");
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password. 
                                        Please choose a different password.");
        }
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }

}