<?php

namespace App\Models\Attendance;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Ignug\State;
use App\Models\Ignug\Catalogue;

class Attendance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-ignug';
    protected $fillable = [
        'date'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d'
    ];

    public function attendanceable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function workdays()
    {
        return $this->morphMany(Workday::class, 'workdayable');
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}
