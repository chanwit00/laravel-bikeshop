<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

    public function typebook() {
        return $this->belongsTo('App\Models\Typebook');
    }
    use HasFactory;
}
