<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function OrderReport($OrderID)
    {
        $SQL="SELECT 

        users.name,
        Branch.BName,Branch.Baddress,Branch.BFB,Branch.BWhats,Branch.BMail,Branch.BWebSite,Branch.BPhones,Branch.BFax,
        TOrder.phone,TOrder.address,TOrder.price,TOrder.paid,TOrder.created_at
        FROM `TOrder`
        join users on users.id=TOrder.createby
        JOIN Branch on Branch.BID=TOrder.BID
        WHERE TOrder.OrderID=$OrderID";

        $Order=DB::select($SQL)[0];

        $SQL="select Document.DOName,DocumentType.DName,Serves.Serves,sum(DocumentServes.price) as price
        from DocumentServes 
        join Document on DocumentServes.DID=Document.DID
        JOIN DocumentType on DocumentType.DTypeID=Document.DTypeID
        JOIN Serves on Serves.SID =DocumentServes.SID
        WHERE Document.OrderID=$OrderID
        GROUP by  Document.DOName,DocumentType.DName,Serves.Serves";
        $DocumentServes=  DB::select($SQL);
 
  
        $Data=array('Order'=>$Order,'DocumentServes'=>$DocumentServes);


        return view('Order.OrderReport',$Data);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Order.Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
          $this->validate($request,
              [
                  'phone' => 'required',
              ]);
             
              $Order = new Order();
              $Order->fill( $request->only($Order->getFillable()));
              $Order->BID=Auth::user()->BID;
              $Order->createby=Auth::user()->id;
              $Order->save();
              
               return redirect()
                          ->action('OrderController@edit',$Order->OrderID)
                          ->with('success', 'تم  الاضافه بنجاح');
     
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $Order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function edit($OrderID)
    {
      
        $Data['OrderID']=$OrderID ;//Order::find( $OrderID) ;

        return view("Order.edit",$Data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $Order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $Order)
    {
        //
    }
}
