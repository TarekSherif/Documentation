<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'TOrder';
    protected $fillable = [ 'phone', 'address', 'Otherphone', 'price', 'Cost', 'createby', 'BID', 'createTime', 'EDate', 'Locked'];
    protected $primaryKey = 'OrderID';
    
}
