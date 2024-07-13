<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'date_start',
        'date_end',
        'explanation',
        'status',
        'status_approved'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
