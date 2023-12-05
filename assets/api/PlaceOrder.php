<?php
session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;
$PostData =json_decode(file_get_contents("php://input"));
//echo json_encode($PostData);return;
$flag=true;
$OrderNumber ="1" ;
if(!isset($_SESSION["UID"])){echo 'Error';return;}
$UID=$_SESSION["UID"];
$BillAmount=0;
$ShopId = $PostData[0]->UID;
$con=$db->GetActiveConnection();
 
if($db->ScalerQueryOnConnection("select COUNT(*) from orders",$con)>0)$OrderNumber=$db->ScalerQueryOnConnection("SELECT MAX(OrderNumber)+1 FROM orders",$con);
foreach($PostData as $order)
{
    $db->NonQueryOnConnection("INSERT INTO `orderinfo`(`ProductID`,`Quantity`,`OrderNumber`,`TotalPrice`) VALUES(".$order->MID.",".$order->Quantity.",".$OrderNumber.",".$order->Quantity*$order->Price.")",$con);
    $BillAmount = $BillAmount + ($order->Quantity * $order->Price);
}
$sql = "INSERT INTO `orders`(`UID`,`OrderNumber`,`OrderDate`,`BillAmount`,`ShopID`) VALUES (".$UID.",".$OrderNumber.",NOW(),".$BillAmount.",".$ShopId.");";

if($db->NonQueryOnConnection($sql,$con))
{
    $Response["Status"]='Success';
    $Response["Message"]="Order Placed Successfully"; 
}
else{
    $Response["Status"]='Error';
    $Response["Message"]=$sql; 
}
$con->close();
echo json_encode($Response);

?>