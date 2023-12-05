<?php
session_start();
    include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID='1';if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];
{
    $SQL="SELECT * from requests where UID=".$UID;
}

$result=$db->GetResult($SQL);
$myArray = array();
while($row = $result->fetch_assoc())
{
    $myArray[] = $row;
}
//shuffle($myArray);
echo json_encode($myArray);

//else echo 'error !!!';

?>