<?php
 function RoleMenu($ViewGroup)
{
      $RID=(Auth::check())?Auth::user()->role:0;
      $roleMenu = array();
       $SQL ="SELECT `ViewName`.`ViewName` ,`ViewName`.`ViewIcon`,`ViewName`.`ViewPath`,`ViewName`.`ARName`
              FROM `ViewName`    join `ViewRolePermission` 
              on `ViewName`.`ViewName`=`ViewRolePermission`.`ViewName`and 
              `ViewRolePermission`.`RID`=$RID and
              `ViewRolePermission`.`ShowData`=true  and 
              `ViewName`.`ViewGroup`='$ViewGroup' 
              order by `ViewName`.`SOrder`";

       $Data= DB::select($SQL);
       if(!empty($Data) &&  $RID!=0 )
       {
              $roleMenu=  json_decode(json_encode($Data), true) ;
       }


       return  $roleMenu;

}
function PagePermission ($viewName = "")
{
       $RID=(Auth::check())?Auth::user()->role:0;
       $Permission = array(
              'ShowData'=> false, 
              'InsertData'=> false,
              'UpdateData'=> false,
              'DeleteData'=> false,
              'DataToExcel'=> false,
              'DataToPrint'=> false );

    $SQL ="SELECT    `ViewRolePermission`.`ShowData`,
                     `ViewRolePermission`.`InsertData`,
                     `ViewRolePermission`.`UpdateData`,
                     `ViewRolePermission`.`DeleteData` ,
                     `ViewRolePermission`.`DataToExcel`,
                     `ViewRolePermission`.`DataToPrint` 
             FROM `ViewName`    join `ViewRolePermission` 
              on `ViewName`.`ViewName`=`ViewRolePermission`.`ViewName`and  `ViewName`.`ViewPath`='$viewName' and  `RID`=$RID";
    $Data= DB::select($SQL);
    if(!empty($Data) &&  $RID!=0 )
    {
       $Permission=  json_decode(json_encode($Data[0]), true) ;
    }
 

    return $Permission;
  
}


function GetBranches ( )
{
       $SQL ='SELECT `BID` as "Value",`BName` as "DisplayText" FROM `Branch` order by SOrder ';
       $Data= DB::select($SQL);
       return  $Data;
}
       

function GetBranchName($Branches) {
           $DName="";
           $BID=(Auth::check())?Auth::user()->BID:0;
          foreach ($Branches as $Branch) {
                if ($Branch->Value==$BID) {
                     $DName=$Branch->DisplayText;
                }
          }
         return $DName;
       }
           
       