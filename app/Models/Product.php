<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id' ,
        'product_category_id' ,
        'name' ,
        'description' ,
        'content' ,
        'price' ,
        'qty' ,
        'discount' ,
        'weight' ,
        'sku' ,
        'featured' ,
        'tag'
    ];
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function productCategory()
    {
        return $this->belongsTo(Product_category::class,'product_category_id','id');
    }
    public function productImages()
    {
        return $this->hasMany(Product_image::class,'product_id','id');
    }
    public function productDetails()
    {
        return $this->hasMany(Product_detail::class,'product_id','id');
    }
    public function productComments()
    {
        return $this->hasMany(Product_comment::class,'product_id','id');
    }
}
