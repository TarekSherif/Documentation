<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\OnlinePayment;
use Illuminate\Http\Request;

class OnlinePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Data =$this->GetLookUpData();
        return view("OnlinePayment.Create",$Data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $Emp = new Emp();
        // $data = $request->only($Emp->getFillable());
        // $Emp->fill($data)->save();

        $this->validate($request,
        [
            'OCode' => 'required' ,
            'ODate' => 'required' ,
            'TCode' => 'required' ,
            'address' => 'required' ,
            'passportID' => 'required' ,
            'OName' => 'required' ,
            'DTypeID' => 'required' ,
            'SID' => 'required' ,
            'Cost' => 'required' ,
            'ReceiptCode' => 'required' ,
        ],
        [
            'required'=> ':attribute field is required',
        ]);
 /* <!-- /resources/views/post/create.blade.php -->
          <h1>Create Post</h1>
         @if (errors->any())
             <div class='alert alert-danger'>
                 <ul>
                     @foreach (errors->all() as error)
                         <li>{{ error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif
 <!-- Create Post Form --> */
        $OnlinePayment = new OnlinePayment();
        $OnlinePayment->fill( $request->only($OnlinePayment->getFillable()));
        $OnlinePayment->BID=Auth::user()->BID;
        $OnlinePayment->createby=Auth::user()->id;
        $OnlinePayment->save();
        
         return redirect()
                    ->action('OnlinePaymentController@show',$OnlinePayment->OnlinePaymentID)
                    ->with('success', 'تم  الاضافه بنجاح');
        
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlinePayment  $onlinePayment
     * @return \Illuminate\Http\Response
     */
    public function show(OnlinePayment $onlinePayment, $id)
    {
        //
        $Data =$this->GetLookUpData();
        $Data['OnlinePayment']= OnlinePayment::find( $id) ;
        return view("OnlinePayment.Show",$Data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlinePayment  $onlinePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlinePayment $onlinePayment, $id)
    {
        $Data =$this->GetLookUpData();
        $Data['OnlinePayment']= OnlinePayment::find( $id) ;

        return view("OnlinePayment.edit",$Data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlinePayment  $onlinePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnlinePayment $onlinePayment)
    {
        //
        $this->validate($request,
        [
            'OCode' => 'required' ,
            'ODate' => 'required' ,
            'TCode' => 'required' ,
            'address' => 'required' ,
            'passportID' => 'required' ,
            'OName' => 'required' ,
            'DTypeID' => 'required' ,
            'SID' => 'required' ,
            'Cost' => 'required' ,
            'ReceiptCode' => 'required' ,
        ],
        [
            'required'=> ':attribute field is required',
        ]);
        
        $OnlinePayment = OnlinePayment::find( $id) ;
        $OnlinePayment->fill( $request->only($OnlinePayment->getFillable()));
        $OnlinePayment->BID=Auth::user()->BID;
        $OnlinePayment->createby=Auth::user()->id;
        $OnlinePayment->save();
        
         return redirect()
                    ->action('OnlinePaymentController@show',$OnlinePayment->OnlinePaymentID)
                    ->with('success', 'تم  الاضافه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlinePayment  $onlinePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnlinePayment $onlinePayment)
    {
        //
    }



    
 private  function GetLookUpData()
 {
     $OnlinePayment =new OnlinePayment();
    return array(
        'OnlinePayment'=> $OnlinePayment,
        'Serves' => DB::select('select SID,Serves from Serves ;') ,
     );
 }



}
