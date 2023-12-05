<?php
session_start();
    include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID="1";
if(isset($_GET["UID"])) $UID=$_GET["UID"];
else if(isset($_SESSION["UID"])){$UID=$_SESSION["UID"]; }
else{
    $Response["Status"]='Error';
    $Response["Message"]="Invalid User";
    echo  json_encode($Response);
    return;
}

$SQL="SELECT * from medicines where UID=".$UID;
                  
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