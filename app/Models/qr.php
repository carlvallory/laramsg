<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qr extends Model
{
    use HasFactory;

    protected $table = 'qr';

    protected $fillable = [
        'qr_str'
    ];
}