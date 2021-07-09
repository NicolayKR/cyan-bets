<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_flat',
        'id_offer',
        'url_offer',
        'current_bet',
        'leader_bet',
        'position',
        'page',
        'id_user'
    ];
}
