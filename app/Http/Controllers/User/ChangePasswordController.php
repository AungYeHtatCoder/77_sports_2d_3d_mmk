<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('frontend.changePassword');
    } 
    // public function ChangenewPassword(Request $request)
    // {
    //     // Validate the request
    //     $this->validate($request, [
    //         'current_password' => 'required',
    //         'new_password' => 'required|min:8|confirmed',
    //         'new_password_confirmation' => 'required',
    //     ]);

    //     // Check current password
    //     $user = Auth::user();
    //     if (!Hash::check($request->input('current_password'), $user->password)) {
    //         // If the passwords don't match, return error
    //         return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
    //     }
    //     // Update password
    //     $user->password = Hash::make($request->input('new_password'));
    //     $user->save();
    //     session()->flash('passwordChanged', 'Password changed successfully.');
    //     // Return redirect route back success message or redirect
    //     return redirect()->back()->with('success', 'Password changed successfully.');
       
    // }

    public function ChangenewPassword(Request $request)
{
    // Validate the request
    $this->validate($request, [
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
        'new_password_confirmation' => 'required',
    ]);

    // Check if new_password and new_password_confirmation are the same
    if ($request->input('new_password') !== $request->input('new_password_confirmation')) {
        session()->flash('passwordMismatch', 'New password and confirmation password do not match.');
        return redirect()->back();
    }

    // Check current password
    $user = Auth::user();

    // Update password
    $user->password = Hash::make($request->input('new_password'));
    $user->save();

    // Flash success message
    session()->flash('passwordChanged', 'Password changed successfully.');

    // Return redirect route back with success message
    return redirect()->back()->with('success', 'Password changed successfully.');
}


}