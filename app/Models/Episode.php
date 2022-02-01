<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $table = 'episodes';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'air_date',
        'character_id',
        'episode',
        'url',
        'created'
    ];
    //Defining The model's default values for attributes
    protected $attributes = [
        'name' => '',
        'air_date' => '',
        'character_id' => 0,
        'episode' => '',
        'url' => '',
        'created' => '',
    ];

    public function episodeCharacter()
    {
        //return $this->belongsToMany(Character::class, 'id');
        return $this->belongsToMany([App\Character::class, 'id']);
    }
}
