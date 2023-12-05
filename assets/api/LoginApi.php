<?php
session_start();

$Email=$err="";
if (isset($_GET["Email"]) && isset($_GET["PWD"])) {
    include('../Database/DBMySql.php');$db=new DBMySql;
    
    $Email =  $_GET["Email"];
    $PWD =  $_GET["PWD"];

    
    $sql="select count(*) from `users` where `Email` ='".$Email."' and `PWD` ='".$PWD."';";
   
    if( $db->ScalerQuery($sql)=="1")
    {
        $sql="select * from `users` where `Email` ='".$Email."' and `PWD` ='".$PWD."';";
        $row=$db->GetSingleRow($sql);
        
        $_SESSION["UID"]=$UID = $row["UID"];
        $_SESSION["User"] = $db->GetSingleRow("select * from `users` where UID=".$UID);
        $_SESSION["UserName"]= $row["UserName"];
        $_SESSION["UserType"]= $row["UserType"];
        $_SESSION["ProfileType"]= $row["ProfileType"];

        $_SESSION["Email"]=$Email;
        
        $Response["Status"]='Success';
        $Response["Message"]='Login Successful';

    }
    else{ 
        $Response["Status"]='Error';
        $Response["Message"]=$sql;
       
    }
}else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
   
}
echo json_encode($Response);
?>