<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Auth;

class ClientController extends Controller
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
        ];
    }

    /**
     * Display a listing of clients.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $clients = Client::where('users_id', $adminId)
            ->get();

        return view('client.index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new client.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:5|max:200',
            'email' => 'required|email|unique:clients,email|max:100',
        ], $this->messages());

        $client = Client::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'users_id'  => Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id,
        ]);

        return redirect()
            ->route('clientes.index');
    }

    /**
     * Display the specified client.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $client = Client::where('id', $id)
                    ->where('users_id', $adminId)
                    ->first();
        if($client)
            return view('client.show')
                ->with('client', $client);
        abort(404, 'Cliente não encontrado.');
    }

    /**
     * Show the form for editing the specified client.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $client = Client::where('id', $id)
                    ->where('users_id', $adminId)
                    ->first();
        if($client)
            return view('client.edit')
                ->with('client', $client);
        abort(404, 'Cliente não encontrado.');
    }

    /**
     * Update the specified client in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|min:5|max:200',
            'email' => 'required|email|unique:clients,email,' . $id . '|max:100',
        ], $this->messages());

        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $client = Client::where('id', $id)
                    ->where('users_id', $adminId)
                    ->first();
        if($client)
        {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->save();
        }

        return redirect()
            ->route('clientes.index');
    }

    /**
     * Remove the specified client from storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $client = Client::where('id', $id)
                    ->where('users_id', $adminId)
                    ->first();
        if($client)
            $client->delete();
            
        return redirect()
            ->route('clientes.index');
    }
}
