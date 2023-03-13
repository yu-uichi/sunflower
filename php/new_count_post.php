<?php
require('MySQL_connect.php');
//require('./../../MySQL_connect.php');

$ID = $_POST["ID_"];
$year = $_POST["Year_"];
$month = $_POST["Month_"];
$day = $_POST["Day_"];
$videos = $_POST["Vid_"];
$vid_n = $_POST["Vid_num_"];



//データがなければINSERT
$test = "INSERT INTO `new_count_viewing_videos` (`ID`, `year`, `month`,`day`,`videos`,`videoNum`) values (\"" .$ID. "\",\"" .$year . "\",\"".$month."\",\"".$day."\",\"".$videos."\",\"".$vid_n."\");";

echo($test);
$rst = mysqli_query($mysqli,$test);

$close_flag = mysqli_close($mysqli);

if ($close_flag){
  // print('<p>切断に成功しました。</p>');
}

?>
