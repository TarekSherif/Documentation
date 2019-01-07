<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'TOrder';
    protected $fillable = [ 'phone', 'RecipientName','address', 'Otherphone', 'price', 'paid', 'createby','Recipientby', 'BID', 'EDate', 'Locked'];
    protected $primaryKey = 'OrderID';
    
}
