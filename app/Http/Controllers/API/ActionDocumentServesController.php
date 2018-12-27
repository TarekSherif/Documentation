<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionDocumentServesController extends Controller
{
  

    // public function
    public function UpdateSOrderUp( $DSID,$DID,$SOrder){
        $jTableResult =  array();
        $jTableResult['refresh'] =false;

        if( $SOrder != "1"){
            
            $newSOrder=intval($SOrder)-1;
            $currentServe= ( $newSOrder==1)?"1":"0";

            $SQL="UPDATE DocumentServes SET 
            SOrder =  '" . $SOrder . "' , currentServe=0
            WHERE DID='".$DID."' and SOrder =  '" . $newSOrder . "'" ;
                      
            DB::update($SQL);

           

            $SQL="UPDATE DocumentServes SET 
            SOrder =  '" . $newSOrder . "' , currentServe=$currentServe 
            WHERE DSID='".$DSID."' " ;
                      
            DB::update($SQL);

            $jTableResult['refresh'] =true;
            
        }
        return response()->json($jTableResult);  
       

      
     }
    public function UpdateSOrderDown( $DSID,$DID,$SOrder){
        $jTableResult =  array();
        $jTableResult['refresh'] =false;
        $SQL="select count(*) as MaxOrder from DocumentServes where DID=".$DID;
        $Data=DB::select($SQL);
        $MaxOrder=$Data[0]->MaxOrder;
        if( $SOrder != $MaxOrder){
            
            $newSOrder=intval($SOrder)+1;
            $currentServe= ( $SOrder==1)?"1":"0";

            $SQL="UPDATE DocumentServes SET 
            SOrder =  '" . $SOrder . "' , currentServe=$currentServe
            WHERE DID='".$DID."' and SOrder =  '" . $newSOrder . "'" ;
                      
            DB::update($SQL);

           

            $SQL="UPDATE DocumentServes SET 
            SOrder =  '" . $newSOrder . "' , currentServe=0 
            WHERE DSID='".$DSID."' " ;
                      
            DB::update($SQL);

            $jTableResult['refresh'] =true;
            
        }
        return response()->json($jTableResult);  
       

      
    }
    public function DocumentServesTimeLine($DID)    {
        $jTableResult =  array();
        
        try
        {
            
            //Get records from database
            $SQL ="SELECT 
            `DocumentServes`.`DID`  ,
            `DocumentServes`.`SOrder` , 
            `DocumentServes`.`SDate`  ,
            `DocumentServes`.`EDate`  , 
            `DocumentServes`.`Successfully`,
            `DocumentServes`.`price`,  
            `Document`.`priority`,  
            `Serves`.`Serves`,
            `TOrder`.`OrderID`,
            `TOrder`.`phone`,
            `Document`.`DOName`
        FROM `DocumentServes` 
        JOIN `Serves`    on `Serves`.`SID`=`DocumentServes`.`SID`
        JOIN `Document`  on `Document`.`DID`=`DocumentServes`.`DID` 
        JOIN `TOrder`    on `TOrder`.`OrderID`= `Document`.`OrderID` 
        WHERE `DocumentServes`.`DID`=$DID
        order by `DocumentServes`.`SOrder`   ";
                    

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

  
    public function ListOfCurrentDocumentServes()  {
        $jTableResult =  array();
    
        try
        {
            //Get records from database
             $BID=$_GET["BID"];
           
            
            if($BID=="0"){

                     $SQL ="  SELECT   `Serves`.`SID`,
                                        `Serves`.`Serves`,
                                        count(ListOfDocumentsNeedin.DSID) as ServesInCount ,
                                        count(listofdocumentsneedout.DSID) as ServesOutCount 
                            FROM `ListOfDocumentsNeedin` 
                            RIGHT  JOIN `Serves`  on `ListOfDocumentsNeedin`.`SID`=`Serves`.`SID`
                            LEFT JOIN listofdocumentsneedout on listofdocumentsneedout.SID=`Serves`.`SID`
                            GROUP by `Serves`.`Serves`, `Serves`.`SID` ,`Serves`.`SOrder`
                            ORDER BY `Serves`.`SOrder`
                    ;";
                }else{
                    $SQL=" SELECT   `Serves`.`SID`,
                                    `Serves`.`Serves`,
                                    count(ListOfDocumentsNeedin.DSID) as ServesInCount ,
                                    count(listofdocumentsneedout.DSID) as ServesOutCount 
                            FROM `ListOfDocumentsNeedin` 
                            RIGHT  JOIN `Serves`  on `ListOfDocumentsNeedin`.`SID`=`Serves`.`SID`
                            and ListOfDocumentsNeedin.BID=$BID
                            LEFT JOIN listofdocumentsneedout on listofdocumentsneedout.SID=`Serves`.`SID`
                            and listofdocumentsneedout.BID=$BID
                            GROUP by `Serves`.`Serves`, `Serves`.`SID` ,`Serves`.`SOrder`
                            ORDER BY `Serves`.`SOrder`
                    ";
                    
                }   

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
        
                         
    public function ListOfDocumentsNeedin()   {

        $jTableResult =  array();

        try
        {
                $SQL ="SELECT * from ListOfDocumentsNeedin
                        Where `SID`='" . $_POST["SID"]. "' ";
                        $BID=$_POST["BID"];
                        $SQL .=($BID=="0")?"":" and  `BID`=".$BID ;
            //Get records from database
            
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
    public function UpdateDocumentsInService()    {
        $jTableResult =  array();
    
            try
            {
                    
                $SQL="UPDATE DocumentServes SET 
                SDate =  '" . $_POST["SDate"] . "' 
                WHERE DSID in (".implode(",",$_POST['DSID']).") " ;
                
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
    
            
     public function UpdateDocumentsInEnjazID()    {
        $jTableResult =  array();
    
            try
            {
                $SQL="UPDATE DocumentServes SET 
                CID =  '" . $_POST["CID"] . "' , 
                INCode =  '" . $_POST["INCode"] . "' 
                WHERE DSID = " . $_POST["DSID"];
                
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
    
    public function ListOfDocumentsNeedout()    {
        $jTableResult =  array();
    
            try
            {
                    $SQL ="SELECT * from ListOfDocumentsNeedout
                           where `SID`='" . $_POST["SID"]. "' ";
                
                $BID=$_POST["BID"];
                $SQL .=($BID=="0")?"":" and  `BID`=".$BID ;
                //Get records from database
            
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
    
    public function UpdateDocumentOUTService()    {
        $jTableResult =  array();
    
            try
            {
                $Successfully=$_POST["Successfully"];
                $SQL="UPDATE DocumentServes SET 
                    Successfully= " . $Successfully . " ,
                    EDate =  '" . $_POST["EDate"] . "',
                    currentServe=0
                    WHERE DSID in (".implode(",",$_POST['DSID']).") " ;
                            
                
                DB::update($SQL);


                if($Successfully=="true"){
                    $SQL="select `DID` , `SOrder`  from DocumentServes 
                    WHERE DSID in (".implode(",",$_POST['DSID']).") " ;
                    $Rows= DB::select($SQL);
                    foreach ($Rows as $row) {
                        
                        $SQL="UPDATE DocumentServes SET 
                                currentServe=1
                        WHERE `DID` =$row->DID and  `SOrder`= $row->SOrder+1" ;
                                                        
                    DB::update($SQL);

                    }

                }
                //Return result to jTable
                
                $jTableResult['Result'] = "OK";

                $jTableResult['SQL'] = $SQL;
            }
            catch(Exception $ex)
            {
                //Return error Message
                
                $jTableResult['Result'] = "ERROR";
                $jTableResult['Message'] = $ex->getMessage();
                
            }
            return response()->json($jTableResult);
     }


    public function ListOfDocumentServes($DID)  {
        $jTableResult =  array();
    
        try
        {
            
                $SQL ="SELECT * FROM DocumentServes 
                where   DID='" . $DID. "' 
                order by SOrder ;";

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
    public function CreateDocumentServes()  {
        $jTableResult =  array();

        try
        {
            $currentServe=($_POST["SOrder"]=="1")?"1":"0";
            //Insert record into database
                $SQL="INSERT INTO DocumentServes(`DID` ,`SID` ,`SOrder` ,`price`,`Cost`,`currentServe`)
                VALUES('" . $_POST["DID"] . "','" . $_POST["SID"] . "','" . $_POST["SOrder"] . "','" . $_POST["price"] . "','" . $_POST["Cost"] . "', $currentServe);";
            
            //    $SQL="INSERT INTO DocumentServes(`DID` ,`SID` ,`SOrder` ,`price`,`Cost`)
            //    VALUES('" . $_POST["DID"] . "','" . $_POST["SID"] . "','" . $_POST["SOrder"] . "','" . $_POST["price"] . "','" . $_POST["Cost"] . "');";
                DB::insert( $SQL);
                //Get last inserted record (to return to jTable)
            
                $SQL ="SELECT * FROM DocumentServes  WHERE DSID = LAST_INSERT_ID();";
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
        // dd($jTableResult);
        return response()->json($jTableResult);
     }


    public function UpdateDocumentServes()    {
        $jTableResult =  array();
    
        try
        {

            //Update record in database

            // $currentServe=($_POST["SOrder"]=="1")?"1":"0";
            // SOrder= '" . $_POST["SOrder"] . "' ,
            // currentServe=$currentServe
            $SQL="UPDATE DocumentServes SET 
            DID= '" . $_POST["DID"] . "' ,
            `SID`= '" . $_POST["SID"] . "' ,
            Cost= '" . $_POST["Cost"] . "',
            price=  '" . $_POST["price"] . "'
            WHERE DSID = " . $_POST["DSID"];
            
            DB::update($SQL);

            //Return result to jTable
            
            $jTableResult['Result'] = "OK";

            $jTableResult['SQL'] = $SQL;
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
    public function DeleteDocumentServes()    {
        $jTableResult =  array();
            try
            {
                    //Delete from database
                    $SQL="DELETE FROM DocumentServes WHERE DSID = " . $_POST["DSID"] . ";";
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
