<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffWorkingHour extends Model
{
    use HasFactory;
    protected $table = 'staff_working_hours';
    protected $fillable = [
        'id_user',
        'days',
        'id_working_hour'
    ];

    public function workingHour() {
        return $this->belongsTo(WorkingHour::class, 'id_working_hour');
    }
}
