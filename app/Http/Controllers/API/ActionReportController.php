<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class ActionReportController extends Controller
{
   

    public function BranchDocumentsReport()
    {
          $jTableResult =  array();
          try
          {
            $SQL="SELECT  '1' as OID, TOrder.OrderID,
                    TOrder.phone,
                    Document.DID,
                    Document.DOName,
                    Document.priority,
                    DocumentType.DName,
                    DATE(TOrder.created_at)
                FROM TOrder
                JOIN Document ON TOrder.OrderID=Document.OrderID AND DATE(TOrder.created_at) BETWEEN '2013-03-26' AND '2020-03-27'
                JOIN DocumentType ON DocumentType.DTypeID=Document.DTypeID";

              $Data= DB::select($SQL);
              if(!empty($Data))
              {
                $index=1;
                 foreach ($Data as $row) {
                    $row->OID=$index;
                    $index=$index+1;
                 } 
              }
              $jTableResult['Result'] = "OK";
              $jTableResult['Records'] =$Data;
             
          }
          catch(Exception $ex)
          {
              //Return error Message
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = $ex->getMessage();
             
          }
          return response()->json($jTableResult);
    } 



    


    public function CompanyDocumentsReport()
    {
          $jTableResult =  array();
          try
          {
            $SQL=" SELECT '1' as OID, Document.DOName,DocumentType.DName,DocumentServes.INCode,DocumentServes.DSID  from Document
            JOIN DocumentType on DocumentType.DTypeID=Document.DTypeID 
            JOIN DocumentServes on DocumentServes.DID=Document.DID
            WHERE DocumentServes.CID='". $_POST["CID"]."' 
            and DocumentServes.SDate='" .$_POST["SDate"]."' 
            and DocumentServes.SID='" .$_POST["SID"]."'";
              $Data= DB::select($SQL);
              if(!empty($Data))
              {
                $index=1;
                 foreach ($Data as $row) {
                    $row->OID=$index;
                    $index=$index+1;
                 } 
              }
              $jTableResult['Result'] = "OK";
              $jTableResult['Records'] =$Data;
             
          }
          catch(Exception $ex)
          {
              //Return error Message
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = $ex->getMessage();
             
          }
          return response()->json($jTableResult);
    } 

    
 
                
 }
     