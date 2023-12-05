<?php

session_start();
include("../Database/DBMySql.php");$db= new DBMySql;

$Keyword=$Class='';
$ID='1';

$sql="SELECT `MockPaperName`,`StartTime`,`TotalMarks`,r.MID as MID,RID FROM `mockpapers` m,`results` r WHERE m.`MID`=r.`MID` AND SID=".$ID;
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
