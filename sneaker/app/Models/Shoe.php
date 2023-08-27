<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $table = 'shoe';

    public function brand() {
        return $this->belongsTo('App\Models\Brand');
    }
    use HasFactory;
}
