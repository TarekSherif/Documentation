<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    //
    protected $table = 'OnlinePayment';
    // protected $fillable = [ 'OnlinePaymentID', 'OCode', 'ODate', 'TCode', 'address', 'passportID', 'OName', 'DType', 'ActionType', 'Cost', 'ReceiptCode', 'Locked', 'BID', 'createby'];
     protected $fillable = [  'OCode', 'ODate', 'TCode', 'address', 'passportID', 'OName', 'DType', 'ActionType', 'Cost', 'ReceiptCode', 'Locked', 'BID', 'createby'];
    protected $primaryKey='OnlinePaymentID';
    protected $attributes = [
         'address' => 'القاهرة',
         'passportID' => '' ,
         'Cost'=>8.75,
         'DType'=>'تصديق وثيقة',
         'ActionType'=>'تصديق وثيقة',
          ];
    protected $dates = ['ODate'];

}
