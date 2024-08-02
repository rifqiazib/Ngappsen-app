<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'working_code',
        'working_name',
        'early_entry',
        'entry_time',
        'end_entry',
        'home_time'
    ];

    public function staffWorkingHours()
    {
        return $this->hasMany(StaffWorkingHour::class, 'id_working_hour');
    }
}
