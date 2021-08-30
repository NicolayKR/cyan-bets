<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class errors_publish extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_object','id_offer',
        'errors','warning','id_user'
    ];
}
