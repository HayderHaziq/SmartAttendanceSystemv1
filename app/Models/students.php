<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $table = 'students';

    protected $fillable = ['id', 'student_name', 'student_id', 'class_id', 'teachers', 'created_at', 'updated_at'];

    public function GETCLASS()
    {
        return $this->belongsTo('App\Models\classes', 'class_id');
    }

}
