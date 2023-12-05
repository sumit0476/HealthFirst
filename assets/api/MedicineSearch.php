<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$MedicineName='';$ZipCode='';

if(isset($_GET["MedicineName"])){$MedicineName = $_GET["MedicineName"];}
if(isset($_GET["ZipCode"])){$ZipCode = $_GET["ZipCode"];}

$SQL="SELECT DISTINCT UserName, u.* FROM `users` u,`medicines` m WHERE u.`UID`=m.`UID` AND `MedicineName` LIKE '%".$MedicineName."%'";

$result=$db->GetResult($SQL);
$myArray = array();
while($row = $result->fetch_assoc())
{
    $myArray[] = $row;
}
//shuffle($myArray);
echo json_encode($myArray);


?>