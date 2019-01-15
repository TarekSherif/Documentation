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
    
  
    public function ListOfCurrentDocumentServes()  {
        $jTableResult =  array();
    
        try
        {
            //Get records from database
             $BID=$_GET["BID"];
           
             $inBID=$outBID="";
            if($BID != '0'){
              $inBID="  and ListOfDocumentsNeedin.BID=$BID";
              $outBID="  and ListOfDocumentsNeedout.BID=$BID";
            }
                    $SQL ="SELECT  `Serves`.`SID`,
                                    `Serves`.`Serves`,
                                    count(ListOfDocumentsNeedin.DSID) as ServesInCount ,
                                    '1' as ServesOutCount 
                            FROM `ListOfDocumentsNeedin` 
                            RIGHT  JOIN `Serves`  on `ListOfDocumentsNeedin`.`SID`=`Serves`.`SID` $inBID
                            GROUP by `Serves`.`Serves`, `Serves`.`SID` ,`Serves`.`SOrder`,`ServesOutCount`
                            ORDER BY `Serves`.`SOrder` ;";
                    
                    $Data= DB::select($SQL);

                    $SQL ="SELECT   `Serves`.`SID`,
                                   
                                    count(ListOfDocumentsNeedout.DSID) as ServesOutCount 
                    FROM `ListOfDocumentsNeedout` 
                    RIGHT  JOIN `Serves`  on  ListOfDocumentsNeedout.SID=`Serves`.`SID` $outBID
                    GROUP by  `Serves`.`SID` ,`Serves`.`SOrder`
                    ORDER BY `Serves`.`SOrder`;";
                    $DocumentsOut= DB::select($SQL);
                    $index=0;
                    foreach ( $Data as $Serves) {
                        $Serves->ServesOutCount=$DocumentsOut[$index]->ServesOutCount;
                        $index=$index+1;
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
        
                         
    public function ListOfDocumentsNeedin()   {

        $jTableResult =  array();

        try
        {
            $BID=$_POST["BID"];
            $WhereBID  =($BID=="0")?"":" and  `BID`=".$BID ;

                $SQL ="SELECT * from ListOfDocumentsNeedin
                        Where `SID`='" . $_POST["SID"]. "'  $WhereBID 
                        ORDER BY  `priority` DESC";
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
            //$_POST['SID']
            $SID=$_POST['SID'];
            if( $SID==4){
                $Refuse=" and  (  CID IS  NULL or INCode IS  NULL) ";
                $Accepted=" and CID IS NOT NULL  and  INCode IS NOT  NULL ";
                $ErrorMassage="يجب اختيار الشركة وادخال رقم انجاز";
            }elseif($SID==3){
                $Refuse=" and  CID IS  NULL  ";
                $Accepted=" and CID IS NOT NULL  ";
                $ErrorMassage=" يجب اختيار الشركة";
            }
            else {
                $Refuse=" and   0 ";
                $Accepted="";
            }

            try
            {
                $SQL="select DSID from  DocumentServes 
                WHERE (DSID in (".implode(",",$_POST['DSID']).")  $Refuse )" ;
                $WithOutCID=    DB::select($SQL);
                
                $SQL="UPDATE DocumentServes SET 
                SDate =  '" . $_POST["SDate"] . "' 
                WHERE (DSID in (".implode(",",$_POST['DSID']).") $Accepted  )" ;
                        
                DB::update($SQL);

                $jTableResult['Result']=(empty($WithOutCID))? "OK": $ErrorMassage;
                
                
                            

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
                $INCode=(isset( $_POST["INCode"] )?",  INCode =  '" . $_POST["INCode"] . "' ":"");
                $SQL="UPDATE DocumentServes SET 
                CID =  '" . $_POST["CID"] . "'
                $INCode             
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
     public function UpdateDocumentsOut()    {
        $jTableResult =  array();
    
            try
            {
                $SQL="UPDATE DocumentServes SET 
                Notes =  '" . $_POST["Notes"] . "' 
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
                $BID=$_POST["BID"];
                $WhereBID  =($BID=="0")?"":" and  `BID`=".$BID ;

                    $SQL ="SELECT * from ListOfDocumentsNeedout
                           where `SID`='" . $_POST["SID"]. "' $WhereBID";
                
               
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
                $jTableResult['Result'] = "OK";
      
                if($Successfully=="true"){
                        
                    $SQL="UPDATE DocumentServes SET 
                    Successfully= " . $Successfully . " ,
                    EDate =  '" . $_POST["EDate"] . "',
                    currentServe=0
                    WHERE DSID in (".implode(",",$_POST['DSID']).") " ;
                                        
                  DB::update($SQL);

                    $SQL="select `DID` , `SOrder`  from DocumentServes 
                    WHERE DSID in (".implode(",",$_POST['DSID']).") " ;
                    $Rows= DB::select($SQL);
                    foreach ($Rows as $row) {
                        
                        $SQL="UPDATE DocumentServes SET 
                                currentServe=1
                        WHERE `DID` =$row->DID and  `SOrder`= $row->SOrder+1" ;
                                                        
                    DB::update($SQL);

                    }

                }else {
                    $Refuse=" and  (  Notes IS  NULL) ";
                    $Accepted=" and Notes IS NOT  NULL ";
                    $ErrorMassage="يجب  تسجيل  سبب الرفض فى الملاحظات";

                    $SQL="select DSID from  DocumentServes 
                    WHERE (DSID in (".implode(",",$_POST['DSID']).")  $Refuse )" ;
                    $WithOutNotes=    DB::select($SQL);
                    
                    $SQL="UPDATE DocumentServes SET 
                        Successfully= " . $Successfully . " ,
                        EDate =  '" . $_POST["EDate"] . "',
                        currentServe=0
                    WHERE ( DSID in (".implode(",",$_POST['DSID']).") $Accepted  )" ;

                    DB::update($SQL);

                  
                    $jTableResult['Result']=(empty($WithOutNotes))? "OK": $ErrorMassage;
                
              
                }
                //Return result to jTable
                
              

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
            `DID`= '" . $_POST["DID"] . "' ,
            `SID`= '" . $_POST["SID"] . "' ,
            `Notes`= '" . $_POST["Notes"] . "',
            `price`=  '" . $_POST["price"] . "'
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
