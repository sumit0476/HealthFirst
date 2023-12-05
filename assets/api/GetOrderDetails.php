<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$OrderNumber='1';if(isset($_GET["OrderNumber"]))$OrderNumber=$_GET["OrderNumber"];
$SQL="SELECT `MedicineName`,`Price`,`Quantity`,`TotalPrice` FROM `medicines` m,`orderinfo` o WHERE o.`ProductID`=m.`MID` AND o.`OrderNumber`=".$OrderNumber;
   
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