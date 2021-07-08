<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentXml extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_flat',
        'bet',
        'name_agent',
        'id_user',
        'id_company',
        'top'
    ];
}
