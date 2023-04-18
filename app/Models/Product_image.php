<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id' ,
        'path'
    ];
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
