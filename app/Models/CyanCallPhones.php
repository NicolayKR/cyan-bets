<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CyanCallPhones extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'called',
        'id_user',
        'id_company'
    ];
}
