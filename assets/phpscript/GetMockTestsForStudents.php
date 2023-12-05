<?php


//if(session_status()==1) session_start();
//if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"]; else{echo 'UnAuthorized Access' ;return;}
$UID='1';
include("../Database/DBMySql.php");$db= new DBMySql;

$Keyword=$Class='';
if(isset($_POST["Keyword"]))$Keyword=$_POST["Keyword"];
if(isset($_POST["Class"]))$Class=$_POST["Class"];
//$sql="select * from mockpapers where MockPaperName like '%".$Keyword."%' and UID = ".$UID." order by MID DESC";
$sql="SELECT m.MID,`MockPaperName`,Duration, COUNT(QID) AS QuestionCount,`Marks`,`NegativeMarks`,`Status` FROM `mockpapers` m LEFT JOIN `questions` q ON q.`MID`=m.`MID` AND  m.`UID`=".$UID."  GROUP BY m.MID;";
$result=$db->GetResult($sql);
$myArray = array();
if($result){
    while($row = $result->fetch_assoc())
    {
        $myArray[] = $row;
    }
    echo json_encode($myArray);
}
else{echo $sql;}

?>
