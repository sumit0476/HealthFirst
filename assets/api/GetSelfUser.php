<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

if(isset($_GET["Update"]))
{
    $_SESSION["User"] = $db->GetSingleRow("select * from `users` where UID=".$_SESSION["UID"]);    
}


if(isset($_SESSION["User"])) echo json_encode($_SESSION["User"]);
//else $_SESSION["User"] = $db->GetSingleRow("select * from users where UID=1");

else echo "Error";


?>
