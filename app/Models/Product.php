<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'feature',
        'product_hot',
        'quantity',
        'price',
        'discount_price',
    ];

    public function category() {
        return $this->belongsTo(Product::class,'category_id','id');
    }

    public function product_comment() {
        return $this->hasMany(Comment::class,'product_id','id');
    }
    
    public function product_reply() {
        return $this->hasMany(Reply::class,'product_id','id');
    }

    public function Order() {
        return $this->hasMany(Order::class,'product_id','id');
    }
}
