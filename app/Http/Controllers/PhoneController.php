<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phone;
use App\Client;
use Auth;

class PhoneController extends Controller
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
            'regex'    => 'Número em formato inválido. Formatos aceitos: +55 (99) 99999-9999 ou +55 (99) 9999-9999',
        ];
    }

    /**
     * Display a listing of phones.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $phones = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', $adminId)
            ->get();

        return view('phone.index')
            ->with('phones', $phones);
    }

    /**
     * Show the form for creating a new phone.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $clients = Client::where('users_id', $adminId)
            ->get();

        return view('phone.create')
            ->with('clients', $clients);
    }

    /**
     * Store a newly created phone in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $request->validate([
            'clients_id' => 'required',
            'number'     => 'required|regex:/\+\d{2}\s\(\d{2}\)\s\d{4,5}\-\d{4}/',
        ], $this->messages());

        $client = Client::where('id', $request->clients_id)
            ->where('users_id', $adminId)
            ->first();
        if($client)
        {
            $client = Phone::create([
                'number'     => $request->number,
                'clients_id' => $client->id,
            ]);

            return redirect()
                ->route('telefones.index');
        }
        abort(404, 'Cliente não encontrado.');
    }

    /**
     * Display the specified phone.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', $adminId)
            ->where('phones.id', $id)
            ->get();
        if($phone)
            return view('phone.show')
                ->with('phone', $phone);
        abort(404, 'Telefone não encontrado.');
    }

    /**
     * Show the form for editing the specified phone.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', $adminId)
            ->where('phones.id', $id)
            ->first();
        if($phone)
            return view('phone.edit')
                ->with('phone', $phone);
        abort(404, 'Telefone não encontrado.');
    }

    /**
     * Update the specified phone in storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|regex:/\+\d{2}\s\(\d{2}\)\s\d{4,5}\-\d{4}/',
        ], $this->messages());

        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', $adminId)
            ->where('phones.id', $id)
            ->first();
        if($phone)
        {
            $phone->number = $request->number;
            $phone->save();
        }

        return redirect()
            ->route('telefones.index');
    }

    /**
     * Remove the specified phone from storage.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adminId = Auth::user()->isAdmin() ? Auth::user()->id : Auth::user()->users_id;

        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', $adminId)
            ->where('phones.id', $id)
            ->first();
        if($phone)
            $phone->delete();
        
        return redirect()
            ->route('telefones.index');
    }
}
