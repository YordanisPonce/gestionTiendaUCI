<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AreaProduct extends Model
{
    use HasFactory;
    protected $fillable = ['area_id', 'product_id', 'count',  'user_id'];
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
