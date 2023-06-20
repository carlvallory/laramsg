<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = $dt->format("l");

        return $this->belongsTo(Schedule::class, 'schedule_start', 'start')
                        ->where('day', $today);
    }

    public function scopeGetTodayMsgs(Builder $query) {
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = $dt->format("Y-m-d");

        return $query->whereDate('created_at', $today);
    }
}
