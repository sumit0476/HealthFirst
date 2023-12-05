<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID='1';if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];
if(isset($_GET["OthersID"])){
    $Me = $UID;
    $You = $_GET["OthersID"];
    $Message= $_GET["Message"];

    $SQL="INSERT INTO `messages`(`SenderID`,`RecieverID`,`Message`,`MessageDateTime`) VALUES(".$Me.",".$You.",'".$Message."',NOW())";
    if($db->GetResult($SQL))
    {
        $Response["Status"]='Success';
        $Response["Message"]='Message Sent Successfully';
        echo json_encode($Response);return;
    }
   
    $Response["Status"]='Error';
    $Response["Values"]=$SQL;
    echo json_encode($Response);return;
}
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
    echo json_encode($Response);return;
}


?>