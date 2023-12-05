<?php
session_start();
include("../Database/DBMySql.php");$db= new DBMySql;

$DID='1';$MID='1';
if(isset($_GET["PickingDate"]) && isset($_GET["ConfirmedBy"])&& isset($_GET["RID"]))// && isset($_GET["DID"]))
{
    $PickingDate=$_GET["PickTime"];
    $ConfirmedBy=$_GET["ConfirmedBy"];
    $RID=$_GET["RID"];
    $sql="UPDATE `requests` SET `PickingDate`='".$PickingDate."',`Status`='Picked',`ConfirmedBy`='".$ConfirmedBy."' WHERE RID=".$RID;
}
if(isset($_GET["ConfirmedBy"]) && isset($_GET["RID"])&& isset($_GET["Status"]))// && isset($_GET["DID"]))
{
    $RID=$_GET["RID"];
    $ConfirmedBy=$_GET["ConfirmedBy"];
    $Status=$_GET["Status"];

    $sql="UPDATE `requests` SET `Status`='".$Status."',`ConfirmedBy`='".$ConfirmedBy."' WHERE RID=".$RID;
}




if($db->NonQuery($sql)){echo "success";return;}
    else{ echo $sql;}


?>