<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientIndex;
use Carbon\Carbon;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->paginate(10);
        return view('clients.index')->with('clients', $clients);
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
            'name'   => 'required',
            'age'    => 'required|numeric|digits_between:1,2',
            'height' => 'required|numeric|digits_between:1,3',
            'weight' => 'required|numeric|digits_between:1,3',
            'gender' => 'required'
        ]);

        $client       = Client::create(request(['name','email','age','height','weight', 'activity',  'gender']));   
            
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
        $client = Client::find($id);
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

    public function calculate($id)
    {
        $previous_client_index = ClientIndex::where('client_id', $id)->get();
        if($this->validatePreviousIndex($previous_client_index)){
            return redirect('clients/' . $id)->with('error', 'One measure per month is avaliable');
        }
   
        $client       = Client::find($id);
        $height_in_m  = $client->height / 100;
        $weight       = $client->weight;
        $age          = $client->age;
        $gender       = $client->gender;

        $bmi          = $this->calculateBmi($weight, $height_in_m);
        $bmr          = $this->calculateBrm($gender, $age, $weight, $client->height);
        
        $color = $this->setIndexColor($bmi);
        $client_index = ClientIndex::create([
            'bmiIndex' => $bmi, 
            'bmrIndex' => $bmr, 
            'client_id' => $id, 
            'status' => $color
            ]);
        $client_index->save();
        return view('clients.show')->with('client', $client);
    }

    private function calculateBmi($weight, $height)
    {
       return $weight / ( $height * $height);
    }

    private function calculateBrm($gender, $age, $weight, $height)
    {
        if($gender === 'male'){
            return  66.47 + (13.7 * $weight) + (5 + $height) - (6.8 * $age);
        }
        return 655.1 + (9.6 * $weight) + (1.8 + $height) - (4.7 * $age);
       
    }

    private function setIndexColor($value)
    {
        if($value < 18.5) return 'red';
        if($this->nBetween($value, 18.5, 24.9)) return 'green';
        if($this->nBetween($value, 25, 29.9)) return 'orange';
        if($value > 30) return 'red';
    }

    private function nBetween($value, $min, $max) 
    {
        if(($min <= $value) && ($value <= $max)) return true;
        return false;
    }

    private function validatePreviousIndex($previous_client_index) 
    {
        if($previous_client_index->isNotEmpty()){
            $date_measured = $previous_client_index->last()->created_at;
            $diff_in_months = Carbon::now()->diffInMonths($date_measured);
            if($diff_in_months === 0){
                return true;
            }           
        }
    }


}
