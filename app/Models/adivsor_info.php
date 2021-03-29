<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adivsor_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'advisorname',
        'email',
        'phone',
        'skill',
        'advise',
        'mcacc',
        'tech',
        'userid',
    ];
}
