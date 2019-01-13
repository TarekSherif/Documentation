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
        return view('welcome');
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
