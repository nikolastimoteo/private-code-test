<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /**
     * Get login page.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return View
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Post login form and authenticate the user.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  Request $request
     * @return Redirect
     */
    public function postLogin(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials))
            return redirect()
                ->route('getHome');
        else
            return redirect()
                ->back()
                ->with('error', 'E-mail e/ou senha incorreto(s)');
    }

    /**
     * Post logout form and logs out the user.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  Request $request
     * @return Redirect
     */
    public function postLogout(Request $request)
    {
        Auth::logout();
        return redirect()
            ->route('login');
    }
}
