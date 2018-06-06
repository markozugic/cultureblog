<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientIndex extends Model
{

    protected $fillable = [
        'bmiIndex', 'bmrIndex', 'client_id', 'status'
    ];

     //Table name 
     protected $table = 'client_index';

     //Primary Key
     public $primaryKey = 'id';
 
     //Timestamps
     public $timestamps = true;

    public function client(){
        return $this->belongsTo('App\Client');
    }
}
