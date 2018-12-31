<?php

namespace App\Http\Controllers\API;
use DB;
use Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ActionusersController extends Controller
{

    
        //Getting records (listAction)
        public function ListOfusers()
        {
          $jTableResult =  array();
        
              try
              {
                  $SQL ="SELECT * FROM users  order by id";
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
        public function Createuser()
        {
            
          $jTableResult =  array();
                  try 
                  {

                    
                          //Insert record into database
                          $SQL="INSERT INTO users(name,email,password,role,BID) VALUES('" . $_POST["name"] . "' ,'" . $_POST["email"] . "','" . $_POST["password"]. "','" . $_POST["role"] . "','" . $_POST["BID"] . "');";
                          DB::insert( $SQL);
                          //Get last inserted record (to return to jTable)
                         
                          $SQL ="SELECT * FROM users WHERE id = LAST_INSERT_ID();";
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
      
          
              public function Updateuser()
              {
                  $jTableResult =  array();
              
                      try
                      {
      
                          //Update record in database
                          //  password= '" . Hash::make($_POST["password"] ) . "',
                          $SQL="UPDATE users SET
                             name = '" . $_POST["name"] . "',
                             email= '" . $_POST["email"] . "',
                             password= '" . $_POST["password"]  . "',
                             role= '" . $_POST["role"] . "',
                             BID= '" . $_POST["BID"] . "' 
                            WHERE id = " . $_POST["id"];
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
                    public function Deleteuser()
                    {
                      $jTableResult =  array();
                          try
                          {
                                  //Delete from database
                                  $SQL="DELETE FROM users WHERE id = " . $_POST["id"] . ";";
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
              
              function login() {    
                $user = User::where(['email'=>$_POST["email"],'password'=> $_POST["password"] ])->first();
                if($user){
                     Auth::login($user);
                } 
                print_r( $user);
            }
      }
      