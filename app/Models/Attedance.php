<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attedance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'entry_time',
        'home_time',
        'entry_location',
        'home_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
