<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $table = 'classes';

    protected $fillable = ['id', 'class', 'teacher', 'subject', 'time_in', 'time_out', 'created_at', 'updated_at'];

    public function GETTEACHER()
    {
        return $this->belongsTo('App\Models\User', 'teacher');
    }
    
}
