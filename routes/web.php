<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'TransactionController@index')->name('home');

// resources
Route::resource('OnlinePayment','OnlinePaymentController');
Route::resource('Order','OrderController');
// Report
Route::get('OrderReport/{OrderID}', 'OrderController@OrderReport');
Route::get('CompanyReport/{SID}', 'TransactionController@CompanyReport')->where('SID', '(3|4)');

Route::get('DocumentIN/{SID}', 'TransactionController@DocumentIN');
Route::get('DocumentOUT/{SID}', 'TransactionController@DocumentOUT');



Route::middleware(['auth'])->group(function () {
    // lookupTables   OR   Setting
    Route::view('Branchs', 'LookupTables.Branchs');
    Route::view('users', 'LookupTables.users');
    Route::view('Serves', 'LookupTables.Serves');
    Route::view('DocumentTypes', 'LookupTables.DocumentTypes');
    Route::view('Company', 'LookupTables.Company');
    Route::view('ViewName', 'LookupTables.ViewName');
    Route::view('Permission', 'LookupTables.Permission'); 
    
});






Route::get('lang/{lang}',  function($lang)
{
    session()->has("lang")?session()->forget("lang"):"";
    $lang=="ar"?  session()->put("lang","ar"):  session()->put("lang","en");
    return back();
});

 





