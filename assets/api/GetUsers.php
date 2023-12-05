<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';$City='';
if(isset($_GET["all"]))$SQL="SELECT * from users";
else if(isset($_GET["UID"]))$SQL="SELECT * from users where UID=".$_GET["UID"];
else if(isset($_GET["City"]))$SQL="SELECT * from users where City like '%".$_GET["City"]."%'";
else if(isset($_GET["PinCode"]))$SQL="SELECT * from users where Address like '%".$_GET["PinCode"]."%'";
else if(isset($_GET["Keyword"]))$SQL="SELECT * from users where Concat(Address,UserName,Services) like '%".$_GET["Keyword"]."%' and ProfileType <> 'User'";

else if(isset($_SESSION["UID"]))$SQL="SELECT * from users where UID=".$_SESSION["UID"];
else {
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
    echo json_encode($Response); return;
}

$result=$db->GetResult($SQL);
$myArray = array();
while($row = $result->fetch_assoc())
{
    $myArray[] = $row;
}
//shuffle($myArray);
echo json_encode($myArray);


?>