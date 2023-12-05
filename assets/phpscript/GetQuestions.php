<?php
session_start();
include("../Database/DBMySql.php");$db= new DBMySql;

$MID=$Class='';
$MID='1';
if(isset($_POST["mid"]))$MID=$_POST["mid"];

$sql="select * from questions where MID =".$MID;
$result=$db->GetResult($sql);
$myArray = array();
if($result){
    while($row = $result->fetch_assoc())
    {
        $myArray[] = $row;
    }
    echo json_encode($myArray);
}
else{echo 'Error';}

?>
