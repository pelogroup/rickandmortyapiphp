<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $table = 'residents';
    protected $fillable = [
        'user_id',
        'character_id',
        'location_id'
    ];
    //Defining The model's default values for attributes
    protected $attributes = [
        'user_id' => 0,
        'character_id' => 0,
        'location_id' => 0,
    ];
}
