<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Admin\CountryCode;
use App\Models\Admin\Currency;
use App\Models\User;
use App\Rules\UniquePhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', "Already Logged In.");
        }
        $countryCodes = CountryCode::all();
        return view('frontend.login', compact('countryCodes'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'country_code' => 'required',
            'phone' => ['required', new UniquePhone()],
            'password' => 'required|min:6'
        ]);
        $credentials = $request->only('country_code', 'phone', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('phone', $request->phone)->first();
            foreach($user->roles as $role){
                if($role->title == "Admin"){
                    return redirect()->route('home')->with('success', "Login Successfully.");
                }else{
                    abort(403, "You have no authorized.");
                }
            } 
        }
        return redirect()->back()->with(['error' => 'Invalid credentials']);
    }

    public function registerForm()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', "Already Logged In.");
        }
        $countryCodes = CountryCode::all();
        $currencies = Currency::all();
        return view('frontend.register', compact('countryCodes', 'currencies'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            //'user_currency' => ['required', 'string'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:6']
        ]);
        $user = User::create([
            'name' => $request->name,
            //'user_currency' => $request->user_currency,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    //$user->roles()->sync($request->input('roles', []));
        // user assign role default user
        $user->roles()->sync([4]);
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Registration successful');
    }
}