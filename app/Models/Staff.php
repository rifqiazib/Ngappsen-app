<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'position',
        'id_department',
        'id_user'
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'id_department');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
