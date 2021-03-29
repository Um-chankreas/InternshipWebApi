<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentdetail extends Model
{
    use HasFactory;
    protected $fillable = [
                'stuName',
                'email',
                'room',
                'generate',
                'defensedate',
                'fromtime',
                'totime',
                'topic',
                'company',
                'advisor',
                'studentid'
    ];
}
