<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID='1';if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];

if(isset($_GET['MedicineName']))
{

    $MedicineName=$_GET['MedicineName'];
    $Price=$_GET['Price'];
    
    $SQL="INSERT INTO medicines(`MedicineName`,`Price`,UID) VALUES('".$MedicineName."','".$Price."',".$UID.")";

    if($db->NonQuery($SQL))
    {
        
        $Response["Status"]='Success';
        $Response["Message"]='Medicine Added.';
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]=$sql;
    }

}
else{
    $Response["Status"]='Error';
    $Response["Message"]="Invalid Parameters";
}
echo json_encode($Response);



?>