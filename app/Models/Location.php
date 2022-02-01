<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        //'character_origin_id',
        'character_id',
        'type',
        'dimension',
        'url',
        'created'
    ];
    //Defining The model's default values for attributes
    protected $attributes = [
        'name' => '',
        //'character_origin_id' => 0,
        'character_id' => 0,
        'type' => '',
        'dimension' => '',
        'url' => '',
        'created' => '',
    ];

    public function locationCharacter()
    {
        //return $this->belongsToMany(Character::class, 'id');
        return $this->belongsToMany([App\Character::class, 'id']);
    }
}
