<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'deadline',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

}


