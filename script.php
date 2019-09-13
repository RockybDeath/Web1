<?php
session_start();
if (!isset($_SESSION['results'])) {
    $_SESSION['results'] = [] ;
}
resultPage();
 function isCorrect(){
     $valueX=false; $valueY=false; $valueR=false;
     foreach ($_GET as $key => $value) {
        $value=str_replace(',',".",$value);
        if ($key=="Y" && 3>=$value && $value>=-3 && is_numeric($value) )$valueY=true;
        elseif  ($key=="X" && 5>=$value && $value>=-3 && is_numeric($value)) $valueX=true;
        elseif ($key=="R" && 3>=$value && $value>=-3 && is_numeric($value)) $valueR=true;
     }
     if(!($valueR && $valueX && $valueY)) return false;
     else return true;
 }
 function writeHtml($html){
         return '<html lang="en">
                <head>
                <meta charset="UTF-8">
                    <title>RESULT</title>
                    <link href="style.css" rel="stylesheet" type="text/css">
                </head>
                <body id="mainBody">
             <table>
                    <tr>
    <th Shapka="cool">Кудымов Валерий Сергеевич<br>
    Группа P3202<br>Вариант 202011</th></tr>'
             . $html .
             '<tr><p><a href=index.html class="superButton">I want to back</a></p></tr>
    </table></body>
            </html>';
 }
function Error(){
    echo '<html lang="en">
                <head>
                <meta charset="UTF-8">
                    <title>RESULT</title>
                    <link href="style.css" rel="stylesheet" type="text/css">
                </head>
                <body id="mainBody">
                   <h1>I am so angry</h1>
<tr><p><a href=index.html class="superButton">I want to back</a></p></tr>
      </body>
            </html>';
}

function resultTable(){
    return '<pre>
               
<table align="center" width="60%" bgcolor="#adff2f">
    <tr>
    <th width="10%" Shapka="cool">X</th>
    <th width="10%" Shapka="cool">Y</th>
    <th width="10%" Shapka="cool">R</th>
    <th width="10%" Shapka="cool">Result</th>
    <th width="10%" Shapka="cool">Time(msec)</th>
    <th width="10%" Shapka="cool">Current Time</th>
</tr>'.
generateTR(10).'
</table>
             
            </pre>';
}
function result(){
    $x=$_GET["X"];
    $y=$_GET["Y"];
    $r=$_GET["R"];
    $x=str_replace(',',".",$x);
    $y=str_replace(',',".",$y);
    $r=str_replace(',',".",$r);
    if(0>=$x && $x>=(-1*$r) && $y>=0 && $r>=$y) return true;
    elseif($x>=0 && $r>=$x && $y>=0 && ($r/2)>=$y) return true;
    elseif($x>=0 && ($r/2)>=$x && 0>=$y && $y>=(-1*$r)) return true;
    else return false;
}
function generateTR($limit){
    while (count($_SESSION["results"]) >= $limit) array_shift($_SESSION["results"]);
     $tr="";
     foreach ($_SESSION["results"] as $result){
         $tr= $tr . '<tr>';
         foreach ($result as $key=>$value){
             $tr=$tr.'<th width="10%" Shapka="cool">'.$value.'</th>';
         }
         $tr=$tr."</tr>";
     }
     return $tr;
}
function resultPage(){
    $startTime = explode(' ', microtime());
    $isCorrect = isCorrect();
    if (! $isCorrect)
        Error();
    else {
        $x=$_GET["X"];
        $y=$_GET["Y"];
        $r=$_GET["R"];
        if(result()) $result="Hit";
        else $result="Miss";
        $endTime = explode(' ', microtime());
        $sec=$endTime[1]-$startTime[1]; $mSec=$endTime[0]-$startTime[0];
        if($sec===0) $Time=round(($mSec*1000),3);
        else $Time=round(($sec+$mSec)*1000,3);
        $_SESSION["results"][]=array("X"=>$x,"Y"=>$y, "R"=>$r, "Result"=>$result, "Time"=>$Time, "CurrentTime"=>date("H:i:s", strtotime('+3 hour')));
        $table = resultTable();
        echo writeHtml($table);
    }
}
?>
