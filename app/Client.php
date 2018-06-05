<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'email', 'age', 'height', 'weight', 'gender', 'activity'
    ];

     //Table name 
     protected $table = 'clients';

     //Primary Key
     public $primaryKey = 'id';
 
     //Timestamps
     public $timestamps = true;

    public function client_index(){
        return $this->hasMany('App\ClientIndex');
    }


}
