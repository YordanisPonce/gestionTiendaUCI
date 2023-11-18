<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaProduct extends Model
{
    use HasFactory;
    protected $fillable = ['area_id', 'product_id', 'count'];
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
