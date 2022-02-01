<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppearEpisode extends Model
{
    use HasFactory;
    protected $table = 'appear_episodes';
    protected $fillable = [
        'user_id',
        'character_id',
        'episode_id'
    ];
    //Defining The model's default values for attributes
    protected $attributes = [
        'user_id' => 0,
        'character_id' => 0,
        'episode_id' => 0,
    ];
}
