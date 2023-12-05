<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';$RMessages=$SMessages=false;$myArray=[];
$UID='1';if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];
$Recievers = $db->GetSingleColumnArray("SELECT DISTINCT RecieverID FROM `messages`  WHERE `SenderID`=".$UID." GROUP BY `RecieverID`");
$Senders = $db->GetSingleColumnArray("SELECT DISTINCT SenderID FROM `messages`  WHERE `RecieverID`=".$UID." GROUP BY `SenderID`");
$IDs =array_merge($Recievers,$Senders);
if(count($IDs)==0){echo "Error"; return;}
$IdAndName = $db->GetResult("SELECT UID,UserName FROM users WHERE UID IN(".implode(",", $IDs).")");

while($row = $IdAndName->fetch_assoc()) { $myArray[] = $row;}

echo json_encode($myArray);



//$RMessages = $db->GetResult("SELECT `SenderID`,`RecieverID`,`Message`,`MessageDateTime`,`Seen` FROM `messages` WHERE RecieverID in (".implode(",", $Recievers).")");
//$SMessages = $db->GetResult("SELECT `SenderID`,`RecieverID`,`Message`,`MessageDateTime`,`Seen` FROM `messages` WHERE SenderID in (".implode(",", $Senders).")");
//if($RMessages)while($row = $RMessages->fetch_assoc())
//            {
//                $myArray[] = $row;
//            }
//if($SMessages)while($row = $SMessages->fetch_assoc())
//    {
//        $myArray[] = $row;
//    }

return;






//    $result=$db->GetResult("");

//    $myArray = array();
//    while($row = $result->fetch_assoc())
//    {
//        $myArray[] = $row;
//    }
    
//    if($result){  
    
//    $Response["Status"]='Success';
//    $Response["Values"]=$myArray;
//    echo json_encode($Response);return;
//}
//else{
//    $Response["Status"]='Error';
//    $Response["Message"]='Invalid Parameters';
//    echo json_encode($Response);return;
//}


?>