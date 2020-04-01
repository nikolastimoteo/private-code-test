<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
            'array'          => 'Selecione ao menos 1 opção.',
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
        $groups = Auth::user()->admin()->roles;

        return view('user.create')
            ->with('groups', $groups);
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
            'email'                 => 'required|email|unique:users,email,NULL,id,deleted_at,NULL|max:100',
            'password'              => 'required|min:8|max:20',
            'password_confirmation' => 'required|same:password',
            'groups'                => 'sometimes|array',
        ], $this->messages());

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'users_id'  => Auth::user()->id,
        ]);

        if($request->exists('groups') && !empty($request->groups))
        {
            $groups = Auth::user()->admin()->roles->whereIn('id', $request->groups);

            $user->assignRole($groups);
        }

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
        $groups = Auth::user()->admin()->roles;

        $user = User::where('id', $id)
                    ->where('users_id', Auth::user()->id)
                    ->first();
        if($user)
            return view('user.edit')
                ->with([
                    'user'   => $user,
                    'groups' => $groups,
                ]);
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
            'name'   => 'required|min:5|max:200',
            'groups' => 'sometimes|array',
        ], $this->messages());

        $user = User::where('id', $id)
                    ->where('users_id', Auth::user()->id)
                    ->first();
        if($user)
        {
            $user->name = $request->name;
            $user->save();
            
            $groups = Auth::user()->admin()->roles->whereIn('id', $request->groups);

            $user->syncRoles($groups);
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
