<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID='1';$City='';$AID='1';
if(isset($_GET["AID"])){
    $SQL="SELECT a.AID,a.UID,`Title`,a.`Address`,a.`City`,`Cost`,`Capacity`,`PostedOn`,Email,Mobile,Username FROM ads a,users u WHERE u.`UID`=a.`UID` AND AID=".$_GET["AID"];

    $Ad=$db->GetSingleRow($SQL);
    if($Ad){
        $SQL="SELECT i.UID,UserName,Mobile FROM users u,interests i WHERE u.`UID`=i.`UID` AND i.AID=".$_GET["AID"];

        $result=$db->GetResult($SQL);
        $myArray = array();
        while($row = $result->fetch_assoc())
        {
            $myArray[] = $row;
        }


        $Ad["InterestedUsers"]=$myArray;
        $Response["Status"]='Success';
        $Response["Values"]=$Ad;
        echo json_encode($Response);return;
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]='Invalid Parameters';
        echo json_encode($Response);return;
    }



}
else if(isset($_GET["City"]))$SQL="SELECT * from ads where City like '%".$_GET["City"]."%'";
else if(isset($_SESSION["UID"]))$SQL="SELECT * from ads where UID=".$_SESSION["UID"];
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
    echo json_encode($Response);return;
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