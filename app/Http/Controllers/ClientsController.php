<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients                    = Client::orderBy('created_at', 'desc')->paginate(10);
        return view('clients.index')
                                ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                 => 'required',
            'age'                  => 'required|numeric|digits_between:1,2',
            'height'               => 'required|numeric|digits_between:1,3',
            'weight'               => 'required|numeric|digits_between:1,3',
            'gender'               => 'required'
        ]);
        $client                     = Client::create([
                        'name'     => $request->input('name'),
                        'email'    => $request->input('name'),
                        'age'      => $request->input('age'),
                        'height'   => $request->input('height'),
                        'weight'   => $request->input('weight'),
                        'activity' => $request->input('activity'),
                        'gender'   => $request->input('gender') === 'male' ? 1: 2
                        ]);   
            
        $client->save();
        return redirect('/clients')->with('success', 'Client created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client                     = Client::find($id);
        return view('clients.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
