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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function Orders()
    // {
    //     return view('Orders');
    // }
   


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Order($OrderID=-1)
    {
        $Data = array('OrderID' => $OrderID );
        return view('Order.Order',$Data);
    }

   
    public function DocumentIN($SID=-1)
    {
        $Data= array('SID' => $SID );
        return view('DocumentIN',$Data);
    }
    public function DocumentOUT($SID=-1)
    {
       

        $Data= array('SID' => $SID );
        return view('DocumentOUT',$Data);
    }
      
 
    public function CompanyReport()
    {
        $SQL="select     `CID`  ,  `CName` from Company order by   `SOrder` ;";
        $Data = array('Company' => DB::select( $SQL) );
        return view('CompanyReport', $Data);
    }
    

    

}
