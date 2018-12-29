<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionServesController extends Controller {
    
    
    //{{url("/")}}/api/ServesListoptions
    public function ServesListoptions($multiple=false)    {

        $jTableResult =  array();
        
            try
            {
                
                $SQL =($multiple?
                'SELECT `Serves` as "Value",`Serves` as "DisplayText" FROM `Serves` order by SOrder ':
                'SELECT `SID` as "Value",`Serves` as "DisplayText" FROM `Serves` order by SOrder ' );
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
    public function ListOfServes()    {
        $jTableResult =  array();
    
            try
            {
                $SQL ="SELECT * FROM Serves order by SOrder ";
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
    public function CreateServes()  {
        
        $jTableResult =  array();
                try
                {
                        //Insert record into database
                        $SQL="INSERT INTO Serves(Serves ,Nprice, Qprice,NCost, QCost,SOrder) VALUES('" . $_POST["Serves"] . "','" . $_POST["Nprice"] . "', '" . $_POST["Qprice"] . "','" . $_POST["NCost"] . "', '" . $_POST["QCost"] . "','" . $_POST["SOrder"] . "');";
                        DB::insert( $SQL);
                        //Get last inserted record (to return to jTable)
                    
                        $SQL ="SELECT * FROM Serves WHERE SID = LAST_INSERT_ID() order by SOrder ;";
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


    public function UpdateServes(){
            $jTableResult =  array();
        
                try
                {

                    //Update record in database
                    $SQL="UPDATE Serves SET
                            Serves = '" . $_POST["Serves"] . "' ,
                            Nprice=  '" . $_POST["Nprice"] . "' ,
                            Qprice=  '" . $_POST["Qprice"] . "',
                            NCost=  '" . $_POST["NCost"] . "' ,
                            QCost=  '" . $_POST["QCost"] . "',
                            SOrder = '" . $_POST["SOrder"] . "'
                            WHERE SID = " . $_POST["SID"];
                    
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
    public function DeleteServes() {
            $jTableResult =  array();
                try
                {
                        //Delete from database
                        $SQL="DELETE FROM Serves WHERE SID = " . $_POST["SID"] . ";";
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
