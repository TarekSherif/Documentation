<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionBranchController extends Controller
{
 
//{{url("/")}}/api/BranchListoptions

    public function BranchListoptions()
    {
      $jTableResult =  array();
    
          try
          {
              $SQL ='SELECT `BID` as "Value",`BName` as "DisplayText" FROM `Branch` order by SOrder ';
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
  public function ListOfBranchs()
  {
    $jTableResult =  array();
  
        try
        {
            $SQL ="SELECT * FROM Branch order by SOrder ";
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
  public function CreateBranch()
  {
      
    $jTableResult =  array();
            try
            {
                    //Insert record into database
                    $SQL="INSERT INTO `alhendy`.`Branch` (`BName`, `Baddress`, `BFB`, `BWhats`, `BMail`, `BWebSite`, `BPhones`,`BFax` ,`SOrder`) VALUES ('" . $_POST["BName"] . "', '" . $_POST["Baddress"] . "', '" . $_POST["BFB"] . "', '" . $_POST["BWhats"] . "', '" . $_POST["BMail"] . "', '" . $_POST["BWebSite"] . "', '" . $_POST["BPhones"] . "', '" . $_POST["BFax"] . "','" . $_POST["SOrder"] . "')";
                    
                    DB::insert( $SQL);
                    //Get last inserted record (to return to jTable)
                   
                    $SQL ="SELECT * FROM Branch WHERE `BID`  = LAST_INSERT_ID();";
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


        public function UpdateBranch()
        {
            $jTableResult =  array();
        
                try
                {

                    //Update record in database
                    $SQL="UPDATE `Branch` SET 
                             `BName` = '" . $_POST["BName"] . "' ,
                            `Baddress`= '" . $_POST["Baddress"] . "' ,
                            `BFB`= '" . $_POST["BFB"] . "' ,
                            `BWhats`= '" . $_POST["BWhats"] . "' ,
                            `BMail`= '" . $_POST["BMail"] . "' ,
                            `BWebSite`= '" . $_POST["BWebSite"] . "' ,
                            `BPhones`= '" . $_POST["BPhones"] . "' ,
                            `BFax`= '" . $_POST["BFax"] . "' ,
                            `SOrder`= '" . $_POST["SOrder"] . "' 
                        WHERE  BID = '" . $_POST["BID"] . "' ";
                 
                    
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
              public function DeleteBranch()
              {
                $jTableResult =  array();
                    try
                    {
                            //Delete from database
                            $SQL="DELETE FROM Branch WHERE BID = '" . $_POST["BID"] . "';";
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
