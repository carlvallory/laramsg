<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Msg extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'msgs';

    protected $fillable = [
        'msg_id',
        'msg_from',
        'msg_to',
        'msg_body',
        'msg_name',
        'msg_author',
        'schedule_start'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
