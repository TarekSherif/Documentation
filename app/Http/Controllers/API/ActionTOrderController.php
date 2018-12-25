<?php

namespace App\Http\Controllers\API;

use DB;
use Illuminate\Http\Request;
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
                            `TOrder`.`Cost`,
                            `TOrder`.`createby`,
                            `TOrder`.`createTime`,
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
       public function ListOfOrders()
       {
         $jTableResult =  array();
       
             try
             {
                 $SQL ="SELECT * FROM TOrder";
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
                $SQL="SELECT `o`.`OrderID` ,`o`.`createTime`,`o`.`EDate`,`o`.`phone` , `o`.`BID`,`Document`.`DOName`
                FROM `TOrder` o
                      join Document on `o`.`OrderID`=`Document`.`OrderID` 
                      where `o`.`phone` like $where  $whereBID
                 UNION 
                      SELECT `o`.`OrderID`, `o`.`createTime`,`o`.`EDate`,`o`.`phone` ,`o`.`BID`,`Document`.`DOName`
                       FROM `TOrder` o
                      join Document on `o`.`OrderID`=`Document`.`OrderID` 
                      where `o`.`OrderID` like $where  $whereBID
                UNION 
                    SELECT `o`.`OrderID`,`o`.`createTime`,`o`.`EDate`,`o`.`phone`,`o`.`BID`,`Document`.`DOName`
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
           

          private function insertSQL(){
            $price=(isset($_POST["price"])?$_POST["price"]:"0" );
            $Cost=(isset($_POST["Cost"])?$_POST["Cost"]:"0" );
            $SQL="INSERT INTO TOrder( phone,address,Otherphone,price,Cost ,createby,BID) 
            VALUES( '" . $_POST["phone"] . "','" . $_POST["address"] . "','" . $_POST["Otherphone"] . "'," . $price  . "," . $Cost . "," .  $_POST["createby"]  . "," .  $_POST["BID"]  . ");";
            DB::insert( $SQL);
         }
         private function updateSQL(){
            $price=(isset($_POST["price"])?$_POST["price"]:"0" );
            $Cost=(isset($_POST["Cost"])?$_POST["Cost"]:"0" );

            $SQL=	"UPDATE TOrder SET
                    phone = '" . $_POST["phone"] . "',
                    address='" . $_POST["address"] . "',
                    Otherphone = '" . $_POST["Otherphone"] . "',
                    price=" .  $price . ",
                    Cost = " . $Cost . "
                    WHERE OrderID = " . $_POST["OrderID"] . ";";
            
          DB::update($SQL);
         }
     //  SaveOrder
  
     public function   SaveOrder()
     {
         
       $jTableResult =  array();
               try
               {
               
                      if($_POST["OrderID"]==-1)
                      {
                        self::insertSQL();
                         $SQL ="SELECT 
                                   `TOrder`.`OrderID`,
                                   `TOrder`.`phone`,
                                   `TOrder`.`address`,
                                   `TOrder`.`Otherphone`,
                                   `TOrder`.`price`,
                                   `TOrder`.`Cost`,
                                   `TOrder`.`createby`,
                                   `TOrder`.`createTime`,
                                   `TOrder`.`EDate`,
                                   `Branch`.`BName`,
                                   `users`.`name`
                               FROM TOrder 
                               JOIN users on users.id= TOrder.createby
                               JOIN Branch on Branch.BID= TOrder.BID 
                               where  `TOrder`.`OrderID` = LAST_INSERT_ID();";
                      }else
                      {
                        self::updateSQL();
                           //Update record in database
                        $SQL ="SELECT 
                                `TOrder`.`OrderID`,
                                `TOrder`.`phone`,
                                `TOrder`.`address`,
                                `TOrder`.`Otherphone`,
                                `TOrder`.`price`,
                                `TOrder`.`Cost`,
                                `TOrder`.`createby`,
                                `TOrder`.`createTime`,
                                `TOrder`.`EDate`,
                                `Branch`.`BName`,
                                `users`.`name`
                            FROM TOrder 
                            JOIN users on users.id= TOrder.createby
                            JOIN Branch on Branch.BID= TOrder.BID 
                            where  `TOrder`.`OrderID` = " . $_POST["OrderID"] ;
                      }
                        
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

       public function CreateOrder()
       {
           
         $jTableResult =  array();
                 try
                 {
                         //Insert record into database
                         self::insertSQL();
                         //Get last inserted record (to return to jTable)
                        
                         $SQL ="SELECT * FROM TOrder WHERE OrderID = LAST_INSERT_ID();";
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
     
     
             public function UpdateOrder()
             {
                 $jTableResult =  array();
             
                     try
                     {
                    
                        //   Oname = '" . $_POST["Oname"] . "',
                        // Sdate = '" . $_POST["Sdate"] . "',
                        // Edate='" . $_POST["Edate"] . "'
                         //Update record in database
                         self::updateSQL();
      
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
                   public function DeleteOrder()
                   {
                     $jTableResult =  array();
                         try
                         {
                                 //Delete from database
                                 $SQL="DELETE FROM TOrder WHERE OrderID = " . $_POST["OrderID"] . ";";
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
     