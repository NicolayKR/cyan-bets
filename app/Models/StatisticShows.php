<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticShows extends Model
{
    use HasFactory;
    protected $fillable = [
            'coverage',
            'searches_count',
            'shows_count',
            'phone_shows',
            'views',
            'id_user',
            'id_company',
    ];
}
