<?PHP
if(session_status()==1){session_start();}
$PostData =json_decode(file_get_contents("php://input"));


$Name=$Mobile=$Email=$PWD=$Address=$Services=$RegCode="";
include('../Database/DBMySql.php'); $db=new DBMySql;


$err=$CID="";
if (isset($PostData->UserName)) {

    $Name=$PostData->UserName;
    $Mobile=$PostData->Mobile;
    $Email=$PostData->Email;
    $PWD=$PostData->PWD;
    $Address=$PostData->Address;
    if(isset($PostData->Services))$Services=$PostData->Services;
    if(isset($PostData->RegCode))$RegCode=$PostData->RegCode;
    $ProfileType=$PostData->ProfileType;


    if($db->ScalerQuery("select count(*) from users where Mobile='".$Mobile."'")!="0")  {$Response["Status"]='Error';$Response["Message"]='Mobile Already Exist.';}
    else if($db->ScalerQuery("select count(*) from users where Email='".$Email."'")!="0")  {$Response["Status"]='Error';$Response["Message"]='Email Already Exist.';}
    else
    {
        $sql="INSERT INTO users(`UserName`,`Mobile`,PWD,CreatedOn,Email,Address,Services,RegCode,ProfileType) VALUES('".$Name."','".$Mobile."','".$PWD."',NOW(),'".$Email."','".$Address."','".$Services."','".$RegCode."','".$ProfileType."');";
        if($db->NonQuery($sql))
        {
            $_SESSION["User"]=$db->GetSingleRow("select * from users where Mobile='".$Mobile."' AND Email='".$Email."'");
            $_SESSION["UID"]=$_SESSION["User"]['UID'];
            $_SESSION["ProfileType"]=$ProfileType;
            
            $Response["Status"]='Success';
            $Response["Message"]='SingUp Successful';

        }
        else{
            $Response["Status"]='Error';
            $Response["Message"]=$sql;
        }

    }
}
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
}
echo json_encode($Response);

?>