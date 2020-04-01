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
            'required' => 'Campo obrigatório.',
            'min'      => 'Digite no mínimo :min caracteres.',
            'max'      => 'Digite no máximo :max caracteres.',
            'email'    => 'Digite um email válido.',
            'regex'    => 'Número em formato inválido. Formatos aceitos: +99 (99) 99999-9999 ou +99 (99) 9999-9999',
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
        $clients = Client::where('users_id', Auth::user()->admin()->id)
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
            'name'     => 'required|min:5|max:200',
            'email'    => 'required|email|max:100',
            'phones'   => 'sometimes|array',
            'phones.*' => 'required|regex:/\+\d{2}\s\(\d{2}\)\s\d{4,5}\-\d{4}/',
        ], $this->messages());

        $client = Client::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'users_id'  => Auth::user()->admin()->id,
        ]);

        if($request->exists('phones') && !empty($request->phones))
        {
            $phonesArray = array_map(function($phone) {
                return [ 'number' => $phone ];
            }, $request->phones);

            $client->phones()->createMany($phonesArray);
        }
        

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
        $client = Client::where('id', $id)
                    ->where('users_id', Auth::user()->admin()->id)
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
        $client = Client::where('id', $id)
                    ->where('users_id', Auth::user()->admin()->id)
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
            'email' => 'required|email|max:100',
        ], $this->messages());

        $client = Client::where('id', $id)
                    ->where('users_id', Auth::user()->admin()->id)
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
        $client = Client::where('id', $id)
                    ->where('users_id', Auth::user()->admin()->id)
                    ->first();
        if($client)
            $client->delete();
            
        return redirect()
            ->route('clientes.index');
    }
}
