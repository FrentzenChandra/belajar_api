<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $table= "destinations";

    protected $fillable = [
        'trip_id',
        'location',
        'description',
    ];

    public function trip(){
        return $this->belongsTo(Trip::class , 'trip_id' , 'id');
    }

}
