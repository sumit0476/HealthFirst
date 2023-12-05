<?php
session_start();
include("../Database/DBMySql.php");$db= new DBMySql;

$DID='1';$MID='1';
if(isset($_GET["Latitude"]) && isset($_GET["Longitude"]))// && isset($_GET["DID"]))
{
    $Latitude=$_GET["Latitude"];
    $Longitude=$_GET["Longitude"];
    if(isset($_GET["DID"]))$DID=$_GET["DID"];
    $sql="INSERT INTO `readings`(`Latitude`,`Longitude`,`UploadTime`,`DID`) VALUES('".$Latitude."','".$Longitude."',NOW(),".$DID.");";
    
    if($db->NonQuery($sql)){echo "success";return;}
    else{ echo $sql;}
}

else echo print_r($_POST);// 'Error';

?>
