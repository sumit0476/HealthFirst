<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
if(isset($_SESSION["UID"]))
{
    $UID=$_SESSION["UID"];
    $result=$db->GetResult("SELECT UserName, OrderNumber, BillAmount,Mobile,OrderDate FROM users u,orders o WHERE u.`UID`=o.`UID` AND o.`OrderNumber` IN (SELECT OrderNumber FROM orders WHERE UID IN (SELECT DISTINCT `UID` FROM `orders` WHERE ShopID=".$UID.") AND ShopID=".$UID.")");
    if($result)
    {
        $myArray = array();
        while($row = $result->fetch_assoc())
        {
            $myArray[] = $row;
        }
        $Response["Status"]='Success';
        $Response["Values"]=$myArray;
        echo json_encode($Response);return;
    }
    
    else{
        $Response["Status"]='Success';
        $Response["Message"]='No record Found';
        echo json_encode($Response);return;
    }
}
else
{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
    echo json_encode($Response);return;
}


?>