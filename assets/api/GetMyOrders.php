<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
if(isset($_GET["UID"]))$UID=$_GET["UID"];
$SQL="SELECT OrderNumber,`UserName` as ShopName,`Mobile`,BillAmount,OrderDate FROM users u,orders o WHERE o.`ShopID`=u.`UID` AND o.`UID` = ".$UID." order By OID Desc";
   
    $result=$db->GetResult($SQL);

    $myArray = array();
    while($row = $result->fetch_assoc())
    {
        $myArray[] = $row;
    }
    
    if($result){  
        
        $Response["Status"]='Success';
        $Response["Values"]=$myArray;
        echo json_encode($Response);return;
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]='Invalid Parameters';
        echo json_encode($Response);return;
    }


?>