<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="order";
     protected $fillable = ['invoice','user_id','no_pesananan','status_order_id','subtotal'];
}
