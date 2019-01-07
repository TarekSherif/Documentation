<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class ActionTOrderController extends Controller
{
   
       //Getting records (listAction)

     
       public function GetOrderByOrderID($OrderID=-1)
       {
         $jTableResult =  array();
       
             try
             {

                 $SQL ="SELECT 
                            `TOrder`.`OrderID`,
                            `TOrder`.`phone`,
                            `TOrder`.`address`,
                            `TOrder`.`Otherphone`,
                            `TOrder`.`price`,
                            `TOrder`.`paid`,
                            `TOrder`.`createby`,
                            `TOrder`.`Recipientby`,
                            `TOrder`.`created_at`,
                            `TOrder`.`updated_at`,
                            `TOrder`.`EDate`,
                            `Branch`.`BName`,
                            `users`.`name`
                        FROM TOrder 
                        JOIN users on users.id= TOrder.createby
                        JOIN Branch on Branch.BID= TOrder.BID 
                        where  `TOrder`.`OrderID` = ".$OrderID;

                 $Data= DB::select($SQL);
                 $jTableResult['Result'] = "OK";
                 $jTableResult['Record'] =$Data;
                
             }
             catch(Exception $ex)
             {
                 //Return error Message
                 $jTableResult['Result'] = "ERROR";
                 $jTableResult['Message'] = $ex->getMessage();
                
             }
             return response()->json($jTableResult);
             }
      
             public function ListOfACOnlinePayment()
             {
               $Result =  array();
             
                   try
                   {
                      $where="'".((isset($_GET['term']))?$_GET['term']:"")."%'";
                      // $whereBID=((isset($_GET['BID']) && $_GET['BID']!=0  )?" and BID='".$_GET['BID']."'":"");
                      $whereBID="";
                      $SQL="SELECT  OnlinePayment.OnlinePaymentID, OnlinePayment.OCode   as 'value', OnlinePayment.OCode  as 'label' 
                            from OnlinePayment 
                            where OnlinePayment.OCode like $where  $whereBID;";
                      
       
                      
      
                       $Data= DB::select($SQL);
                       $Result=$Data;
                     
                      
                   }
                   catch(Exception $ex)
                   {
                       //Return error Message
                       $Result['Result'] = "ERROR";
                       $Result['Message'] = $ex->getMessage();
                      
                   }
                   return response()->json($Result);
                   }
                 
//Getting records (ACName)
    public function ListOfACName()
       {
         $Result =  array();
       
             try
             {
                $where="'".((isset($_GET['term']))?$_GET['term']:"")."%'";
                // $whereBID=((isset($_GET['BID']) && $_GET['BID']!=0  )?" and BID='".$_GET['BID']."'":"");
                $whereBID="";
                $SQL="SELECT `o`.`OrderID` ,`o`.`created_at`,`o`.`EDate`,`o`.`phone` , `o`.`BID`,`Document`.`DOName`
                FROM `TOrder` o
                      join Document on `o`.`OrderID`=`Document`.`OrderID` 
                      where `o`.`phone` like $where  $whereBID
                 UNION 
                      SELECT `o`.`OrderID`, `o`.`created_at`,`o`.`EDate`,`o`.`phone` ,`o`.`BID`,`Document`.`DOName`
                       FROM `TOrder` o
                      join Document on `o`.`OrderID`=`Document`.`OrderID` 
                      where `o`.`OrderID` like $where  $whereBID
                UNION 
                    SELECT `o`.`OrderID`,`o`.`created_at`,`o`.`EDate`,`o`.`phone`,`o`.`BID`,`Document`.`DOName`
                      FROM `TOrder`  o
                    join Document on `o`.`OrderID`=`Document`.`OrderID` 
                    where `Document`.`DOName` like $where  $whereBID;";
                
 
                

                 $Data= DB::select($SQL);
                 $Result=$Data;
               
                
             }
             catch(Exception $ex)
             {
                 //Return error Message
                 $Result['Result'] = "ERROR";
                 $Result['Message'] = $ex->getMessage();
                
             }
             return response()->json($Result);
             }
           

           
           
  
     
           public function  OrderTotalPrice($OrderID){
            $jTableResult =  array();
        
            try
            {

                // $SQL="select sum(DocumentServes.price)+IFNULL(Torder.price, 0) as price
                // from DocumentServes 
                // join Document on DocumentServes.DID=Document.DID
                //  join Torder on Torder.OrderID=Document.OrderID
                // WHERE Document.OrderID=" . $OrderID ." 
                // GROUP by Document.OrderID ,Torder.price";
                $SQL="select * from ordertotalprice where OrderID=$OrderID";
                $Data=DB::select($SQL);

                if(!empty($Data)){
                    $jTableResult['price']=$Data[0]->price;
                }

            }
            catch(Exception $ex)
            {
                //Return error Message
                
                $jTableResult['Result'] = "ERROR";
                $jTableResult['Message'] = $ex->getMessage();
            }
            return response()->json($jTableResult);
           }
           public function  IsOrderFinish(){
            $jTableResult =  array();
        
            try
            {

                //Update record in database
                $SQL="UPDATE TOrder SET
                        Locked = true 
                      WHERE OrderID = " . $_POST["OrderID"];
                
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
           public function UpdateTOrderLocked(){
            $jTableResult =  array();
        
                try
                {

                    //Update record in database
                    $SQL="UPDATE TOrder SET
                            Locked = true 
                          WHERE OrderID = " . $_POST["OrderID"];
                    
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
     