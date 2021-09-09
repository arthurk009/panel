<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
        {        
        return ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        }


        protected function sendFailedLoginResponse(Request $request)
        {
            $errors = [$this->username() => trans('auth.failed')];

             // Load user from database
            $user = User::where($this->username(), $request->{$this->username()})->first();

            // Check if user was successfully loaded, that the password matches
            // and active is not 1. If so, override the default error message.
            if ($user && Hash::check($request->password, $user->password) && $user->active != 1) {
                $errors = [$this->username() => trans('auth.noactive')];
            }

            // throw ValidationException::withMessages([
            //     $this->username() => [trans('auth.failed')],
            // ]);
            throw ValidationException::withMessages($errors);
        }
}
