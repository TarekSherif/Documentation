<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
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
    public function Branchs()
    {
        return view('Branchs');
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        return view('users');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Serves()
    {
        return view('Serves');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Company()
    {
        return view('Company');
    }
    public function DocumentTypes()
    {
        return view('DocumentTypes');
    }
    public function ViewName()
    {
        return view('ViewName');
    }
    public function Permission()
    {
        return view('Permission');
    }
    


}
