<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionDocumentController extends Controller
{
  
    //Getting records (listAction)
    public function ListOfDocuments()  {
        $jTableResult =  array();
  
        try
        {
            $SQL ="SELECT 
            `Document`.`DID`,
            `Document`.`DOName`,
            `Document`.`OrderID`,
            `Document`.`DTypeID`,
            `Document`.`priority` ,
            DocumentType.DName
            FROM `Document` JOIN DocumentType on DocumentType.DTypeID=Document.DTypeID 
            where  OrderID='" . $_GET["OrderID"] . "'";
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
    public function CreateDocument()  {
      
        $jTableResult =  array();
        try
        {
                //Insert record into database
                $SQL="INSERT INTO Document(DOName, OrderID,DTypeID,priority) VALUES
                ('" .$_POST["DOName"] . "', '" . $_POST["OrderID"] . "','" . $_POST["DTypeID"] . "'," . $_POST["priority"] . ");";
                DB::insert( $SQL);
                //Get last inserted record (to return to jTable)
                
                $SQL ="SELECT * FROM Document WHERE DID = LAST_INSERT_ID();";
                $Data= DB::select($SQL);
                $Data[0]->Serves=$_POST["ServesH"];
                //  
                $SQL ="SELECT * FROM Serves WHERE SID in (". $Data[0]->Serves.")";
                $ServesData= DB::select($SQL);

                $currentServe="0";
                
                   
                if( $_POST["priority"]){
    
                    foreach ($ServesData as  $value) {
                        $SQL="INSERT INTO DocumentServes(`DID` ,`SID` ,`SOrder` ,`price`,`Cost`, `currentServe`)
                        VALUES('" . $Data[0]->DID . "','" .  $value->SID . "','". $value->SID."','". $value->Qprice."','". $value->QCost."', $currentServe);";
                        DB::insert( $SQL);
                    }

                }
                else
                {
                    
                    foreach ($ServesData as  $index=>$value) {
                        $currentServe=($index==0)?"1":"0";
                        $SQL="INSERT INTO DocumentServes(`DID` ,`SID` ,`SOrder` ,`price`,`Cost`, `currentServe`)
                        VALUES('" . $Data[0]->DID . "','" .  $value->SID . "','". ($index+1)."','". $value->Nprice."','". $value->NCost."', $currentServe);";
                        DB::insert( $SQL);
                    }
                    
                }


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


    public function updateDocument() {
        $jTableResult =  array();
    
        try
        {
            //Update record in database
            $SQL=	"UPDATE Document SET
                DOName = '" . $_POST["DOName"] . "', 
                OrderID = '" . $_POST["OrderID"] . "',
                priority=" . $_POST["priority"] . ",
                DTypeID='" . $_POST["DTypeID"] . "'
                WHERE DID = " . $_POST["DID"] . ";";
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
    public function DeleteDocument() {
        $jTableResult =  array();
        try
        {
                //Delete from database
                $SQL="DELETE FROM Document WHERE DID = " . $_POST["DID"] . ";";
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
