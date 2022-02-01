<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    //public $incrementing = false;
    protected $table = 'characters';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'status',
        'species',
        'type',
        'gender',
        'image',
        'url',
        'origin',
        'location',
        'created'
    ];
    //Defining The model's default values for attributes
    protected $attributes = [
        'name' => '',
        'status' => '',
        'species' => '',
        'type' => '',
        'gender' => '',
        'image' => '',
        'url' => '',
        'created' => '',
    ];

    public function characterEpisode()
    {
        //return $this->hasMany(AppearEpisode::class, 'character_id');
        return $this->hasMany([App\AppearEpisode::class, 'character_id']);
        //return $this->hasManyThrough(Character::class, Postmeta::class);
    }

    public function characterLocation()
    {
        //return $this->hasMany(Location::class, 'character_id');
        return $this->hasMany([App\Location::class, 'character_id']);
    }
}
