<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    //
    protected $table = 'OnlinePayment';
    protected $fillable = [  'OCode', 'ODate', 'TCode', 'address', 'passportID', 'OName', 'DTypeID', 'SID', 'Cost', 'ReceiptCode', 'Locked', 'BID', 'createby'];
    protected $primaryKey='OnlinePaymentID';
    protected $attributes = [ 'address' => 'القاهرة','passportID' => '2018' ,'Cost'=>'8 $'];


}
