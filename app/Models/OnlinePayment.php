<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    //
    protected $table = 'OnlinePayment';
    protected $fillable = [  'OCode', 'ODate', 'TCode', 'address', 'passportID', 'OName', 'DType', 'ActionType', 'Cost', 'ReceiptCode', 'Locked', 'BID', 'createby'];
    protected $primaryKey='OnlinePaymentID';
    protected $attributes = [
         'address' => 'القاهرة',
         'passportID' => '2019' ,
         'Cost'=>8,
         'DType'=>' تصديق شهادة مؤهل',
         'ActionType'=>'تصديق وثيقة',
          ];
    protected $dates = ['ODate'];

}
