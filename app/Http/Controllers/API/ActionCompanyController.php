<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionCompanyController extends Controller
{
 public function CompanyDocuments()
{

      $jTableResult =  array();
    
      try
      {
        $SQL=" SELECT '1' as OID, Document.DOName,DocumentType.DName,DocumentServes.INCode,DocumentServes.DSID  from Document
        JOIN DocumentType on DocumentType.DTypeID=Document.DTypeID 
        JOIN DocumentServes on DocumentServes.DID=Document.DID
        WHERE DocumentServes.CID='". $_POST["CID"]."' and DocumentServes.SDate='" .$_POST["SDate"]."'";
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

    // {{url("/")}}/api/CompanyListoptions
    public function CompanyListoptions()
    {
      $jTableResult =  array();
    
          try
          {
              $SQL ='SELECT `CID` as "Value",`CName` as "DisplayText" FROM `Company` order by SOrder';
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
        public function ListOfCompanys()
        {
          $jTableResult =  array();
        
              try
              {
                  $SQL ="SELECT * FROM Company  order by SOrder  ";
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
        public function CreateCompany()
        {
            
          $jTableResult =  array();
                  try 
                  {
                          //Insert record into database
                          $SQL="INSERT INTO Company(CID,CName,SOrder) VALUES('" . $_POST["CID"] . "' ,'" . $_POST["CName"] . "' ,'" . $_POST["SOrder"] . "');";
                          DB::insert( $SQL);
                          //Get last inserted record (to return to jTable)
                         
                          $SQL ="SELECT * FROM Company WHERE CID = '" . $_POST["CID"] . "' ";
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
      
      
              public function UpdateCompany()
              {
                  $jTableResult =  array();
              
                      try
                      {
      
                          //Update record in database
                          $SQL="UPDATE Company SET
                             CName = '" . $_POST["CName"] . "',
                             SOrder= '" . $_POST["SOrder"] . "'
                            WHERE CID = " . $_POST["CID"];
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
                    public function DeleteCompany()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM Company WHERE CID =" . $_POST["CID"] ;
                                  DB::delete($SQL);
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
      