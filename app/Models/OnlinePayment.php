<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    //
    protected $table = 'OnlinePayment';
    protected $fillable = [  'OCode', 'ODate', 'TCode', 'address', 'passportID', 'OName', 'DType', 'SID', 'Cost', 'ReceiptCode', 'Locked', 'BID', 'createby'];
    protected $primaryKey='OnlinePaymentID';
    protected $attributes = [ 'address' => 'القاهرة','passportID' => '2018' ,'Cost'=>'8 $'];


}
