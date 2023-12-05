<?php
session_start();
    include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
if(isset($_GET["all"]))$SQL="SELECT * from users";
else if(isset($_GET["UID"]))$SQL="SELECT * from users where UID=".$_GET["UID"];
else if(isset($_SESSION["UID"])){$UID=$_SESSION["UID"]; $SQL="SELECT * from users where UID=".$UID;}
else {
    $Response["Status"]='Error';
    $Response["Message"]="Invalid User";
    echo  json_encode($Response);
    return;
}

    $row=$db->GetSingleRow($SQL);
    if($row) {
        $Response["Status"]='Success';
        $Response["Data"]=$row;
        echo  json_encode($Response);
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]="Invalid User";
        echo  json_encode($Response);
    }




?>