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


// Route::get('Orders', 'TransactionController@Orders');
// Route::get('Order/{OrderID?}', 'TransactionController@Order');
Route::get('DocumentIN/{SID?}', 'TransactionController@DocumentIN');
Route::get('DocumentOUT/{SID?}', 'TransactionController@DocumentOUT');

Route::resource('OnlinePayment','OnlinePaymentController');
Route::resource('Order','OrderController');
Route::get('OrderReport/{OrderID}', 'OrderController@OrderReport');

Route::get('CompanyReport', 'TransactionController@CompanyReport');





Route::get('Branchs', 'SettingController@Branchs');
Route::get('users', 'SettingController@users');
Route::get('Serves', 'SettingController@Serves');
Route::get('DocumentTypes', 'SettingController@DocumentTypes');
Route::get('Company', 'SettingController@Company');
Route::get('ViewName', 'SettingController@ViewName');
Route::get('Permission', 'SettingController@Permission');





Route::get('lang/{lang}',  function($lang)
{
    session()->has("lang")?session()->forget("lang"):"";
    $lang=="ar"?  session()->put("lang","ar"):  session()->put("lang","en");
    return back();
});

Route::view('/welcome', 'welcome');



Auth::routes();

Route::get('/', 'TransactionController@index')->name('home');




