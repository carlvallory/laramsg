<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'day',
        'start',
        'stop',
        'title'
    ];

    public function scopeGetTodaySchedules(Builder $query) {
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $today   = Str::lower($dt->format("l"));

        return $query->where('day', $today);
    }
}
