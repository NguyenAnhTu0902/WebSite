<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name' ,
        'email' ,
        'phone' ,
        'adress',
        'payment_type',
        'status',
    ];
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class,'order_id','id');
    }
}
