<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typebook extends Model
{
    protected $table = 'typebook';

    public function books(){
        return $this->hasMany('App\Models\Book');
    }
    use HasFactory;
}
