<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'days'
    ];
}
