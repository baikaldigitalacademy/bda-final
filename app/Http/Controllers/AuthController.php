<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SignInRequest;

class AuthController extends Controller
{
    public function register()
    {
        //
    }

    /**
     * @return View
     */
    public function login(): View
    {
        return view( "login" );
    }

    public function signUp()
    {
        //
    }

    public function signIn( SignInRequest $request )
    {
        $credentials = [
            "login" => $request->get( "login" ),
            "password" => $request->get( "password" )
        ];

        $isLogged = Auth::attempt( $credentials );

        if( !$isLogged ){
            return back()->withInput()->withErrors( "Неверный логин или пароль" );
        }

        return redirect( route( "dashboard" ) );
    }

    public function signOut( Request $request )
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect( route( "login" ) );
    }
}
