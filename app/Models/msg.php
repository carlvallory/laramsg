<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class msg extends Model
{
    use HasFactory;

    protected $table = 'msg';

    protected $fillable = [
        'msg_id',
        'msg_body'
    ];
}
