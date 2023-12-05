<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID='1';if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"]; else return "Error";
if(isset($_GET["OthersID"])){
    $Me = $UID;
    $You = $_GET["OthersID"];
    $SQL="SELECT SenderID,`RecieverID`,Message,`MessageDateTime`,`Seen` FROM messages WHERE `SenderID`=".$Me." AND `RecieverID`=".$You." OR `SenderID`=".$You." AND `RecieverID`=".$Me;
    $result=$db->GetResult($SQL);
    if($result)
    {
        $myArray = array();
        while($row = $result->fetch_assoc())
        {
            $myArray[] = $row;
        }
        
        
        
        $Response["Status"]='Success';
        $Response["Values"]=$myArray;
        echo json_encode($Response);return;
    } 
    if($result->num_rows==0){$Response["Status"]='Success';$Response["Values"]="";echo json_encode($Response);return;
    }
}
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
    echo json_encode($Response);return;
}


?>