<?php




echo 'hello';
function SelectOptionsFormArray($Array,$SelectedValue)
{
    $Output="";
    foreach($Array as $Temp)
    {
        if($Temp==$SelectedValue){ $Output=$Output."<option selected>".$Temp."</option>";}
        else{ $Output=$Output."<option>".$Temp."</option>";}
    }
    return $Output;
}
function SelectOptionsFormResult($result,$SelectedValue)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        if($row[0]==$SelectedValue){ $Output=$Output."<option selected>".$row[0]."</option>";}
        else{ $Output=$Output."<option>".$row[0]."</option>";}
    }
    return $Output;
}
function SelectOptionsWithValues($result,$SelectedValue)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        if($row[1]==$SelectedValue){ $Output=$Output."<option value='".$row[0]."' selected>".$row[1]."</option>";}
        else{ $Output=$Output."<option value='".$row[0]."'>".$row[1]."</option>";}
    } 
    return $Output;
}
function SelectOptionsWithValuesArray($Options,$Values,$SelectedValue)
{
    $Output="";
    $count=0;
    foreach($Options as $Temp)
    {
        if($Values[$count]==$SelectedValue){ $Output=$Output."<option value='".$Values[$count]."' selected>".$Temp."</option>";}
        else{ $Output=$Output."<option value='".$Values[$count]."' >".$Temp."</option>";}
        $count++;
    }
    return $Output;
}
function SelectOptionsWithValues2($result,$SelectedValue)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        if($SelectedValue==$row[0]){$Selected="selected";}else{$Selected="";}
         $Output = $Output . "<option value='".$row[0]."'". $Selected.">".$row[1]."</option>";
    }
    return $Output;
}
function SelectOptionsWithResultRemoveArrayValues($result,$SelectedValue,$ArrayValuesToFilter)
{
    $Output="";
    while($row=mysqli_fetch_array($result))
    {
        $Add=false;
        foreach($ArrayValuesToFilter as $var)       {if($var==$row[0])       {$Add=true;break;}   }    
        if($Add){continue;}
        if($row[0]==$SelectedValue && !$Add){ $Output=$Output."<option selected>".$row[0]."</option>";}
        else{ $Output=$Output."<option>".$row[0]."</option>";}
    }
    return $Output;
}
function PrintTable($Table)
{           
    $firstrow=null;
    if(!$Table || $Table->num_rows==0){return;}
    while($firstrow = $Table->fetch_assoc()) { break; }
    //mysql_data_seek($Table, 0);
    $HTML='<div class="table-responsive"><table class="table table-striped table-hover">';
   
    
    $Header="<thead>";
    foreach(array_keys($firstrow) as $Column){$Header = $Header. '<th>'.$Column.'</th>';}
    $Header=$Header."</thead>";
    
    $TBody="<tbody>";
    while($row=$Table->fetch_assoc())
    {
        $SingleRow="<tr>";
        foreach(array_keys($firstrow) as $Column){$SingleRow=$SingleRow.'<td>'.$row[$Column].'</td>';}
        $SingleRow=$SingleRow."</tr>";

        $TBody=$TBody.$SingleRow;
    }
    $TBody=$TBody.'</tbody>';
    $HTML=$HTML.$Header.$TBody.'</table></div>';
    echo $HTML;
}



    
    






function GetFileArray($Path)
{
    $temp="";
    // Open a directory, and read its contents
    if (is_dir($Path))
    {
        if ($dh = opendir($Path)){
            while (($file = readdir($dh)) !== false) { echo $temp ."," . $file;}
            closedir($dh);
        }
        return explode(",",$temp);
    }
    else{return false;}
}
function GetFileArrayOfExtension($Path,$Extension)
{
    $temp="";
    // Open a directory, and read its contents
    if (is_dir($Path))
    {
        if ($dh = opendir($Path)){
           
            while (($file = readdir($dh)) !== false) { $temp=pathinfo($file);if($temp["extension"]==$Extension){ $temp=$temp ."," . $file;}}
            closedir($dh);
        }
        if (strpos($temp, ',') !== false) {$temp=substr($temp,1);}
        return explode(",",$temp);
    }
    else{return false;}
}
function search_file($dir,$file_to_search){

    $files = scandir($dir);

    foreach($files as $key => $value){

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path)) {
            if($file_to_search == $value){return true;}

        } else if($value != "." && $value != ".."){ search_file($path, $file_to_search); }  
    } 
}
function IsFileExist($file_to_search,$dir){

    $files = scandir($dir);

    foreach($files as $value)
    {

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(is_dir($path)){continue;}
        if($file_to_search == $value){return true;}
        //else{return false;}

    } 
    return false;
}
function DeleteFromArray($Array,$Value)
{
    $Array = array_filter($Array); 
    if (($key = array_search($Value, $Array)) !== false) {
        unset($Array[$key]);
    }
}
function PrintAlert($Var,$AlertType)// $AlertType = warning / info / danger / success
{
    if(isset($Var) && $Var!="") 
    {
        if($Var=="")return;

        $Icon="<i class='fas fa-info-circle'></i>";
        $Icon="<i class='fas fa-exclamation-triangle'></i>";

        echo '<div class="alert alert-'.$AlertType.'" role="alert"><span><strong>'. $Var.'</strong></span></div>';
    }
    
}
function PrintAlertWithIcon($Var,$AlertType,$Icon)// $AlertType = warning / info / danger / success
{
    if($Var=="")return;
    $Class="";
    if($Icon=="Info"){$Class="<i class='fas fa-info-circle'></i>";}
    if($Icon=="Exclamation"){$Class="<i class='fas fa-exclamation-triangle'></i>";}
    if($Icon=="Ok" || $Icon=="Check"){$Class="<i class='fas fa-check'></i>";}
    if($Icon=="Warning"){$Class="<i class='fas fa-info-warning'></i>";}
    if($Icon=="Edit"){$Class="<i class='fas fa-info-edit'></i>";}

    if($Icon=="Search"){$Class="<i class='fas fa-info-search'></i>";}
    if($Icon=="Star" || $Icon=="Rating"){$Class="<i class='fas fa-info-star'></i>";}
    if($Icon=="Close"|| $Icon=="Error" ||$Icon=="Cross"){$Class="<i class='fas fa-info-warning'></i>";}
    if($Icon=="Heart"){$Class="<i class='fas fa-info-Heart'></i>";}
    if($Icon=="Bulb" || $Icon=="Tips"){$Class="<i class='far fa-lightbulb'></i>";}
    if(isset($Var) && $Var!="") 
    {
        echo '<div class="alert alert-'.$AlertType.'" role="alert">'.$Class.' <span><strong>'. $Var.'</strong></span></div>';
    }
    
}
function PrintSmartAlert($Message)// $AlertType = warning / info / danger / success
{ 
    if($Message=="")return;
    $AlertType =explode("-#-",$Message)[0];
    $Var=explode("-#-",$Message)[1];
    if(isset($Var) && $Var!="") 
    {
        echo '<div class="alert alert-'.$AlertType.'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span><strong>'. $Var.'</strong></span></div>';
    }
}
function PrintSmartAnimatedAlert($Message)
{
    if($Message=="")return;
    $AlertType =explode("-#-",$Message)[0];
    $Var=explode("-#-",$Message)[1];
    if(isset($Var) && $Var!="") 
    {
        echo '<div class="alert alert-'.$AlertType.' flash animated" role="alert"><span><strong>'. $Var.'</strong></span></div>';
    }
}
function PrintAlertAdvanced($Message)
{
    echo '<div class="alert text-white bg-success flash animated" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button><span><strong>Alert</strong> text.</span></div>';
}
function PrintVar($Var)// print $Var if exist.
{
    if(isset($Var)&&$Var!="") echo  $Var;
    else echo"";
}

function PrintImage($ImagePath,$DefaultImagePath,$Height,$Width)//Default Image Will be Shown when ImagePath does not exist
{
    if(file_exists($ImagePath))
    {echo '<img class="img-responsive" src="'. $ImagePath.'" width="'.$Width.'" height="'.$Height.'">';}
    else
    {echo '<img class="img-responsive" src="'. $DefaultImagePath.'" width="'.$Width.'" height="'.$Height.'">';}
}

function PrintCrumbBarArray($BreadCrumbElement)
{ 
    if(count($BreadCrumbElement)==0)return;
    echo '<ol class="breadcrumb">';
    for($n=0;$n<count($BreadCrumbElement);$n++)
    {
        echo '<li><a><span>'.$BreadCrumbElement[$n].'</span></a></li>';
    }
    echo "</ol>";
}
function PrintCrumbBarAssociativeArray($BreadCrumbElement,$ThemeType)
{ 
    if(count($BreadCrumbElement)==0)return;
    echo '<ol class="breadcrumb">';
    foreach($BreadCrumbElement as $x => $x_value){
        echo '<li><a class="text-'.$ThemeType.'" href='.$x_value.'><span>'.$x.'</span></a></li>';
    }
    echo "</ol>";
}
function PrintProgressBar($ProgressValue)
{
    echo '<div class="progress">';
    echo '<div class="progress-bar progress-bar-striped active" style="width: '.$ProgressValue.'%;">'.$ProgressValue.'%</div></div>';
}
function PrintProgressBarAdvanced($ProgressValue,$MinValue=0,$MaxValue=100,$Message="",$Theme='primary',$IsStriped=true,$IsActive=true,$Height=16)
{
    $class="";
    $Style='style="height: '.$Height.'px;"';
    $Percentage=$ProgressValue *100 / $MaxValue;
    if($IsStriped)$class=$class." progress-bar-striped";
    if($IsActive)$class=$class." active";
    //$class=$class." progress-bar-".$Theme; // bootstrap 3
    $class=$class." bg-".$Theme; //  boot strap 4
    echo '<div class="progress" '.$Style.'>';
    echo '<div class="progress-bar'.$class.'" aria-valuenow="50" aria-valuemin="0" aria-valuemax="1000" style="width: '.$Percentage.'%;">'.$Message.'</div>';
    echo '</div>';
}
function PrintStepProgressBar($Array,$ActiveItem)
{
    if(count($Array)==0)return; 
    echo "<style>";
    include_once("assets/css/Steps-Progressbar.css");
    echo "</style>";
    $HTML= '<div class="steps-progressbar"><ul>';
    $IsMateched=-1;
    foreach($Array as $Item)
    {
        if($Item==$ActiveItem){$IsMateched=0;}
        if($IsMateched==-1)$HTML=$HTML. '<li class="previous">'.$Item.'</li>';
        else if($IsMateched==0){$HTML=$HTML. '<li class="active">'.$Item.'</li>';$IsMateched=1;}
        else if($IsMateched==1)$HTML=$HTML. '<li>'.$Item.'</li>';
    }
        $HTML=$HTML.'</ul></div>';
        echo $HTML;
}
function CopyImageFromAnotherServer($ImagePathFrom,$ImagePathTo)
{
    if( file_put_contents($ImagePathTo, file_get_contents($ImagePathFrom))) return true;
    else return false;
}
function GetAllUrlFromText($String)
{
    $Count=preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $String, $match);
    $Arr=$match[0];
    return $Arr;
}
function CopyImagesForQuestions($Text,$ExamID)
{
    $UrlList= GetAllUrlFromText($Text);
    foreach($UrlList as $Url)
    {
        $FileName=substr($Url,strrpos($Url,'/')+1);
        $ImagetoSave="assets/img/exampics/".$ExamID."/".$FileName;
        CopyImageFromAnotherServer($Url,$ImagetoSave);
        $Text=str_replace($Url,$ImagetoSave, $Text) ;
    }
    return $Text;
}
function AddToSessionArray($SessionName,$Value)
{
    if(!isset($_SESSION[$SessionName])){$_SESSION[$SessionName]=array($Value);}
    else{ $_SESSION[$SessionName]=array_push($_SESSION[$SessionName],$Value);}
}
function SecondsToTimeDuration($DurationInSeconds)
{
    $hours = floor($DurationInSeconds / 3600);
    $mins = floor($DurationInSeconds / 60 % 60);
    $secs = floor($DurationInSeconds % 60);
    $TimeDuration = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    return $TimeDuration;
}
function DateDifferenceInDays($PastDate,$FutureDate)
{
    //$date1=date_create("2013-03-15");
    //$date2=date_create("2012-12-12");
    $diff=date_diff(date_create($FutureDate),date_create($PastDate));
    $Var=$diff->format("%R%a");
    return $Var;
}
function PrintPagination($RecordCount,$CurrentPage,$DisplayRecordPerPage=10)
{
    //$url= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    if($RecordCount<=$DisplayRecordPerPage)return;
    $url= $_SERVER['PHP_SELF']; $LastRecords="";  
    $Pages=(int)($RecordCount/$DisplayRecordPerPage);
    if(fmod($RecordCount,$DisplayRecordPerPage)>0)$Pages++;
    $LastRecords=fmod($RecordCount,$DisplayRecordPerPage) ;
    echo '<nav style="margin-bottom: -13px;"><ul class="pagination">';
    $n=0;
    $Previous=0;//if($n==0)$Previous=$n;
        $Next=$Pages;//if($n==$Pages)$Previous=$n;
        echo '<li class="page-item"><a class="page-link" aria-label="Previous" onclick="location.replace(\''.$url."?page=".$Previous.'\');"><span aria-hidden="true"><b><<</b></span></a></li>';

    while($n <$Pages)
    {
        if($CurrentPage==$n) echo '<li class="page-item active"><a class="page-link " onclick="location.replace(\''.$url."?page=".$n.'\');">'.($n+1).'</a></li>';
        else echo '<li class="page-item"><a class="page-link " onclick="location.replace(\''.$url."?page=".$n.'\');">'.($n+1).'</a></li>';
        $n++;
    }
    if(($CurrentPage)*$DisplayRecordPerPage +$LastRecords < $RecordCount)echo '<li class="page-item"><a class="page-link" aria-label="Next" onclick="location.replace(\''.$url."?page=".$Next.'\');"><span aria-hidden="true"><b>>></b></span></a></li>';

    echo '</ul></nav>';
}

?>