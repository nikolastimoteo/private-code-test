<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phone;
use App\Client;
use Auth;
use App\Http\Resources\PhoneResource;

class PhoneController extends Controller
{
    /**
     * Cria uma nova instância de TiposAtividadeController
     * 
     *  @return void
     */
    public function __construct()
    {
        $this->middleware('can:admin', ['only' => ['create', 'store']]);
        $this->middleware('can:view-edit-delete-phone', ['only' => ['index']]);
        $this->middleware('permission:view-phone', ['only' => ['show', 'search']]);
        $this->middleware('permission:edit-phone', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-phone', ['only' => ['delete']]);
    }

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
            'regex'    => 'Número em formato inválido. Formatos aceitos: +99 (99) 99999-9999 ou +99 (99) 9999-9999',
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
        $phones = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', Auth::user()->admin()->id)
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
        $clients = Client::where('users_id', Auth::user()->admin()->id)
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
        $request->validate([
            'clients_id' => 'required',
            'number'     => 'required|regex:/\+\d{2}\s\(\d{2}\)\s\d{4,5}\-\d{4}/',
        ], $this->messages());

        $client = Client::where('id', $request->clients_id)
            ->where('users_id', Auth::user()->admin()->id)
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
        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', Auth::user()->admin()->id)
            ->where('phones.id', $id)
            ->first();
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
        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', Auth::user()->admin()->id)
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

        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', Auth::user()->admin()->id)
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
        $phone = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', Auth::user()->admin()->id)
            ->where('phones.id', $id)
            ->first();
        if($phone)
            $phone->delete();
        
        return redirect()
            ->route('telefones.index');
    }

    /**
     * Return the phones that matches the searched term.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = "%" . $request->search . "%";
        $phones = Phone::join('clients', 'phones.clients_id', '=', 'clients.id')
            ->select('phones.*')
            ->where('clients.users_id', Auth::user()->admin()->id)
            ->where(function ($query) use ($search) {
                $query->where('clients.name', 'LIKE', $search)
                ->orWhere('clients.email', 'LIKE', $search)
                ->orWhere('phones.number', 'LIKE', $search);
            })->orderBy('clients.name')->limit(10)->get();
        
        return response()->json([
            'phones' => PhoneResource::collection($phones)
        ], 200);
        
    }
}
