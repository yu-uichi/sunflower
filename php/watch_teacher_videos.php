<?php
//require('./../../MySQL_connect.php');
 require('MySQL_connect.php');

$stu_num = $_POST["ID_"];
$videos = $_POST["ExercisesType_"];
$vid_n = $_POST["Vid_num_"];

//日付
date_default_timezone_set('Asia/Tokyo');
$data_time = date("Y-m-d H:i:s");
// print date("Y/m/d G:i:s");
$exe;

// $stu_num = "admin";
// $videos = 1;
// $vid_n = 1;


switch ($videos) {
  case "1":
    $exe = "ボディメカニクスを活用したベッドメーキング";
    break;
  case "2":
    $exe = "臥症患者のベッドメーキング";
    break;
  case "3":
    $exe = "滅菌手袋の着脱編";
    break;
  case "4":
    $exe = "滅菌状態の確認と取り扱い編";
    break;
  case "5":
    $exe = "無菌操作・消毒綿球の作り方編";
    break;
  case "6":
    $exe = "6R編";
    break;
  case "7":
    $exe = "注射準備編";
    break;
  case "8":
    $exe = "筋肉・皮下注射";
    break;
  default:
}

//データがなければINSERT
$sql = "INSERT INTO `watch_teachersVideos` (`student_number`,`update_at`,`exercises_type`,`video_number`)values(\"".$stu_num."\",\"".$data_time."\",\"".$exe."\",\"".$vid_n."\");";

// echo $sql;
$result = $mysqli -> query($sql);

if(!$result) {
  echo $mysqli->error;
  // print('<p>学籍番号が重複しているか、入力エラーです</p><br>');
  // exit();
}else{
  print('<p>ユーザ登録完了</p><br>');
  print('<p>ユーザ名(学籍番号)とパスワードを忘れないようにしてください。</p>');
}

$close_flag = mysqli_close($mysqli);

if ($close_flag){
  // print('<p>切断に成功しました。</p>');
}

?>
