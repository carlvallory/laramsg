<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'day',
        'start',
        'stop',
        'title'
    ];

    public function scopeGetTodaySchedules(Builder $query) {
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = $dt->format("l");

        return $query->where('day', $today);
    }
}
