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
        'msg_image',
        'msg_name',
        'msg_picture',
        'msg_author',
        'schedule_start',
        'active_at'
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

        return $query->withTrashed()->whereDate('created_at', $today)->orderBy('created_at', 'desc');
    }

    public function scopeGetTodayMsgsWithOnlyImages(Builder $query) {
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = $dt->format("Y-m-d");

        return $query->whereDate('created_at', $today)->whereNotNull('msg_image')->orderBy('created_at', 'desc');
    }

    public function scopeGetTodayActivatedMsgs(Builder $query) {
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = $dt->format("Y-m-d");

        return $query->whereDate('created_at', $today)->whereNotNull('active_at')->orderBy('created_at', 'desc');
    }

    public function scopeGetTodayTrashedMsgs(Builder $query) {
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = $dt->format("Y-m-d");

        return $query->onlyTrashed()->whereDate('created_at', $today)->orderBy('created_at', 'desc');
    }

    public function scopeActivated(Builder $query) {
        return $query->whereNotNull('active_at');
    }

    public function scopeDeactivated(Builder $query) {
        return $query->whereNull('active_at');
    }

    public function isActive() {
        return ($this->whereNotNull('active_at')->get() ? true : false);
    }
}
