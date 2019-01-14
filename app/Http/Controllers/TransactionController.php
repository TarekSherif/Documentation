<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $SQL= 'SELECT  `Branch`.`BID`, `Branch`.`BName`, sum(`DocumentServes`.`price`)+sum(IFNULL(`TOrder`.`price`, 0) ) as price
            from `DocumentServes` 
            join `Document` on `DocumentServes`.`DID`=`Document`.`DID`
            join `TOrder` on `TOrder`.`OrderID`=`Document`.`OrderID`
            join `Branch` on `Branch`.`BID`=`TOrder`.`BID`
            GROUP by   `Branch`.`BID`, `Branch`.`BName`, `TOrder`.`price`;';

           
      $Branches= DB::select($SQL);
  
         $Data=  array('Branches'=>$Branches);
        return view('welcome',$Data);
    }

    public function Order($OrderID=-1)
    {
        $Data = array('OrderID' => $OrderID );
        return view('Order.Order',$Data);
    }

   
    public function DocumentIN($SID)
    {
        $Serves=DB::select("select Serves from Serves where SID = $SID")[0]->Serves;
        $Data= array('SID' => $SID ,    'Serves' => $Serves);
        return view('DocumentIN',$Data);
    }
    public function DocumentOUT($SID)
    {
        $Serves=DB::select("select Serves from Serves where SID = $SID")[0]->Serves;
        $Data= array('SID' => $SID ,    'Serves' => $Serves);
        return view('DocumentOUT',$Data);
    }
      
 
    public function CompanyReport($SID)
    {
        $SQL="select     `CID`  ,  `CName` from Company order by   `SOrder` ;";
        $Data['Company']= DB::select( $SQL) ;
        $Data ['Serves']=DB::select("select SID,Serves from Serves where SID = $SID")[0];

        return view('Reports.CompanyReport', $Data);
    }
    
    public function DocumentINReport($SID)
    {
        $SQL="select     `CID`  ,  `CName` from Company order by   `SOrder` ;";
        $Data['Company']= DB::select( $SQL) ;
        $Data ['Serves']=DB::select("select SID,Serves from Serves where SID = $SID")[0];

        return view('Reports.DocumentINReport', $Data);
    }
    
    

}
