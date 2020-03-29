<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserProfileController extends Controller
{
    /**
     * Get validation messages.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return array
     */
    private function messages()
    {
        return [
            'required'       => 'Campo obrigatório.',
            'min'            => 'Digite no mínimo :min caracteres.',
            'max'            => 'Digite no máximo :max caracteres.',
            'same'           => 'Senha diferente da confirmação.', 
        ];
    }

    /**
     * Get profile page.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return View
     */
    public function getProfile()
    {
        return view('profile.profile');
    }

    /**
     * Post profile form and change the user data.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  Request $request
     * @return Redirect
     */
    public function postProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:200',
        ], $this->messages());

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->route('getHome');
    }

    /**
     * Get change password page.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return View
     */
    public function getChangePassword()
    {
        return view('profile.change-password');
    }

    /**
     * Post change password form and change the user password.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  Request $request
     * @return Redirect
     */
    public function postChangePassword(Request $request)
    {
        $request->validate([
            'password'              => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ], $this->messages());

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('getHome');
    }

}
