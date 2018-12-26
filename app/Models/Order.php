<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'TOrder';
    protected $fillable = [ 'phone', 'address', 'Otherphone', 'price', 'paid', 'createby', 'BID', 'EDate', 'Locked'];
    protected $primaryKey = 'OrderID';
    
}
