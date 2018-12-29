<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionDocumentTypeController extends Controller
{

    public function ListOfACDocumentType()
    {
      $Result =  array();
    
          try
          {
            
            $where=" where DName like '".((isset($_GET['term']))?$_GET['term']:"")."%'";
            $SQL="SELECT DTypeID, `DName` as 'value',`DName` as 'label' FROM `DocumentType` $where ;";
      
            // $where=" where phone like '".((isset($_GET['term']))?$_GET['term']:"")."%'";
            // $SQL="SELECT  `OrderID` as 'value',`phone` as 'label' FROM `TOrder` $where ;";
      

              $Data= DB::select($SQL);
             
              $Result =$Data;
             
          }
          catch(Exception $ex)
          {
              //Return error Message
              $Result['Result'] = "ERROR";
              $Result['Message'] = $ex->getMessage();
             
          }
          return response()->json($Result);
          }


    // {{url("/")}}/api/DocumentTypeListoptions
    public function DocumentTypeListoptions()
    {
      $jTableResult =  array();
    
          try
          {
              $SQL ='SELECT `DTypeID` as "Value",`DName` as "DisplayText" FROM `DocumentType` order by SOrder';
              $Data= DB::select($SQL);
              $jTableResult['Result'] = "OK";
              $jTableResult['Options'] =$Data;
             
          }
          catch(Exception $ex)
          {
              //Return error Message
              $jTableResult['Result'] = "ERROR";
              $jTableResult['Message'] = $ex->getMessage();
             
          }
          return response()->json($jTableResult);
          }

        //Getting records (listAction)
        public function ListOfDocumentTypes()
        {
          $jTableResult =  array();
        
              try
              {
                  $SQL ="SELECT * FROM DocumentType  order by SOrder  ";
                  
                  
                  $Data= DB::select($SQL);
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
      //Creating a new record (createAction)
        public function CreateDocumentType()
        {
            
          $jTableResult =  array();
                  try 
                  {
                          //Insert record into database
                          $SQL="INSERT INTO DocumentType(DName,SOrder) VALUES('" . $_POST["DName"] . "' ,'" . $_POST["SOrder"] . "');";
                          DB::insert( $SQL);
                          //Get last inserted record (to return to jTable)
                         
                          $SQL ="SELECT * FROM DocumentType WHERE DTypeID = LAST_INSERT_ID();";
                          $Data= DB::select($SQL);
                          $jTableResult['Result'] = "OK";
                          $jTableResult['Record'] =$Data[0];
                        
                          
                  }
                  catch(Exception $ex)
                  {
                      //Return error Message
                      
                      $jTableResult['Result'] = "ERROR";
                      $jTableResult['Message'] = $ex->getMessage();
                    
                  }
                  return response()->json($jTableResult);
              }
      
      
              public function UpdateDocumentType()
              {
                  $jTableResult =  array();
              
                      try
                      {
      
                          //Update record in database
                          $SQL="UPDATE DocumentType SET
                             DName = '" . $_POST["DName"] . "',
                             SOrder= '" . $_POST["SOrder"] . "'
                            WHERE DTypeID = " . $_POST["DTypeID"];
                         DB::update($SQL);
       
                          //Return result to jTable
                          
                          $jTableResult['Result'] = "OK";
          
                         
                      }
                      catch(Exception $ex)
                      {
                          //Return error Message
                          
                          $jTableResult['Result'] = "ERROR";
                          $jTableResult['Message'] = $ex->getMessage();
                      }
                      return response()->json($jTableResult);
            
              }
      
                  //Deleting a record (deleteAction)
                    public function DeleteDocumentType()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM DocumentType WHERE DTypeID = " . $_POST["DTypeID"] . ";";
                                  DB::update($SQL);
                                  //Return result to jTable
                                  $jTableResult['Result'] = "OK";
                               
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
      