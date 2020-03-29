<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
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
     * Display a listing of users.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('users_id', Auth::user()->id)
            ->get();

        return view('user.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|min:5|max:200',
            'email'                 => 'required|email|unique:users,email|max:100',
            'password'              => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
        ], $this->messages());

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'users_id'  => Auth::user()->id,
        ]);

        return redirect()
            ->route('usuarios.index');
    }

    /**
     * Display the specified user.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)
                    ->where('users_id', Auth::user()->id)
                    ->first();
        if($user)
            return view('user.show')
                ->with('user', $user);
        abort(404, 'Usuário não encontrado.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)
                    ->where('users_id', Auth::user()->id)
                    ->first();
        if($user)
            return view('user.edit')
                ->with('user', $user);
        abort(404, 'Usuário não encontrado.');
    }

    /**
     * Update the specified user in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:5|max:200',
        ], $this->messages());

        $user = User::where('id', $id)
                    ->where('users_id', Auth::user()->id)
                    ->first();
        if($user)
        {
            $user->name = $request->name;
            $user->save();
        }

        return redirect()
            ->route('usuarios.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)
                    ->where('users_id', Auth::user()->id)
                    ->first();
        if($user)
            $user->delete();
            
        return redirect()
            ->route('usuarios.index');
    }
}
