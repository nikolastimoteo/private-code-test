<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
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
            'email'          => 'Digite um email válido.',
            'email.unique'   => 'E-mail já cadastrado.', 
            'same'           => 'Senha diferente da confirmação.', 
        ];
    }

    /**
     * Get register page.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return View
     */
    public function getRegister()
    {
        return view('register');
    }

    /**
     * Post register form and creates a new user.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  Request $request
     * @return Redirect
     */
    public function postRegister(Request $request)
    {
        $request->validate([
            'name'                  => 'required|min:5|max:200',
            'email'                 => 'required|email|unique:users,email|max:100',
            'password'              => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ], $this->messages());

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Cadastro efetuado. Entre com o e-mail e senha cadastrados.');
    }
}
