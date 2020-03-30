<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Str;

class GroupController extends Controller
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
            'required'         => 'Campo obrigatório.',
            'display_name.min' => 'Digite no mínimo :min caracteres.',
            'display_name.max' => 'Digite no máximo :max caracteres.',
            'permissions.min'  => 'Selecione ao menos :min opção.',
            'array'            => 'Selecione ao menos 1 opção.',
        ];
    }

    /**
     * Display a listing of groups.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin();

        $groups = $admin->roles;

        return view('group.index')
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new group.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('group.create')
            ->with('permissions', $permissions);
    }

    /**
     * Store a newly created group in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'display_name' => 'required|min:5|max:100',
            'permissions'  => 'required|array|min:1',
        ], $this->messages());

        $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin();

        $name = Str::slug($admin->id . ' ' .$request->display_name);
        if($admin->roles->where('name', $name)->count() > 0)
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['display_name' => 'Nome já cadastrado.']);
        
        $group = Role::create([
            'name' => $name,
            'display_name' => $request->display_name,
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)
            ->get();
        $group->syncPermissions($permissions);

        $admin->assignRole($group);

        return redirect()
            ->route('grupos.index');
    }

    /**
     * Display the specified group.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin();

        $group = $admin->roles
            ->where('id', $id)
            ->first();
        if($group)
            return view('group.show')
                ->with('group', $group);
        abort(404, 'Grupo não encontrado.');
    }

    /**
     * Show the form for editing the specified group.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::all();

        $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin();

        $group = $admin->roles
            ->where('id', $id)
            ->first();
        if($group)
            return view('group.edit')
                ->with([
                    'group'       => $group,
                    'permissions' => $permissions,
                ]);
        abort(404, 'Grupo não encontrado.');
    }

    /**
     * Update the specified group in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name' => 'required|min:5|max:100',
            'permissions'  => 'required|array|min:1',
        ], $this->messages());

        $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin();

        $group = $admin->roles
            ->where('id', $id)
            ->first();
        if($group)
        {
            $name = Str::slug($admin->id . ' ' .$request->display_name);
            if($admin->roles->where('name', $name)->where('id', '<>', $id)->count() > 0)
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['display_name' => 'Nome já cadastrado.']);

            $group->name = $name;
            $group->display_name = $request->display_name;
            $group->save();

            $permissions = Permission::whereIn('id', $request->permissions)
                ->get();
            $group->syncPermissions($permissions);
        }

        return redirect()
            ->route('grupos.index');
    }

    /**
     * Remove the specified group from storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Auth::user()->isAdmin() ? Auth::user() : Auth::user()->admin();

        $group = $admin->roles
            ->where('id', $id)
            ->first();
        if($group)
            $group->delete();
            
        return redirect()
            ->route('grupos.index');
    }
}
