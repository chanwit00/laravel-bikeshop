<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';

    public function shoes(){
        return $this->hasMany('App\Models\Shoe');
    }
    use HasFactory;
}
