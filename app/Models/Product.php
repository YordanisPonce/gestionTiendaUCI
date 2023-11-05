<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'amount', 'price', 'format'];
    public function areas(){
        return $this->belongsToMany(Area::class, 'area_products');
    }
}
