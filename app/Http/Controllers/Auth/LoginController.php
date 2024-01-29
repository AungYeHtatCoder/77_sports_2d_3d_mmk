<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//     protected function sendFailedLoginResponse(Request $request)
// {
//     throw ValidationException::withMessages([
//         'email' => [trans('auth.failed')],
//     ])->redirectTo(route('login'))->with('error', 'Your email is not correct and your password did not match.');
// }


protected function sendFailedLoginResponse(Request $request)
{
    throw ValidationException::withMessages([
        'email' => ['Your email is not correct and your password did not match.'],
        'password' => ['Your email is not correct and your password did not match.'],
    ]);
}

}