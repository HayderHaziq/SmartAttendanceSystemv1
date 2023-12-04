<?php

// app\Models\CardReader.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardReader extends Model
{
    use HasFactory;

    protected $table = 'card_readers';

    protected $fillable = ['reader_id', 'class_id', 'created_at', 'updated_at'];

    public function class()
    {
        return $this->belongsTo(classes::class, 'class_id');
    }
}
