<?php


ini_set('display_errors',1);

//require('./../../MySQL_connect.php');
require('./../MySQL_connect.php');



$sql = "CREATE TABLE `teamdigicom_sunflower`.`user_tb` 
(`id` INT(11) NOT NULL AUTO_INCREMENT , 
`family_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`given_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`family_name_kana` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`given_name_kana` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`affiliation_id` INT(11) NOT NULL , 
`student_id` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`teacher` TINYINT(4) NULL , 
`admin` TINYINT(4) NULL , 
`last_login` DATETIME NULL , 
`created_at` DATETIME NULL , 
`updated_at` DATETIME NULL , PRIMARY KEY (`id`)) 
ENGINE = InnoDB;";
echo $sql."<br>";
$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>user_tbテーブル作成成功</p>');
}

echo "<br>";


$sql = "CREATE TABLE IF NOT EXISTS `teamdigicom_sunflower`.`evaluation_myself` ( `id` INT NOT NULL AUTO_INCREMENT , `student_id` TEXT NOT NULL COMMENT '自身の学籍番号' , `watched_at` DATETIME NOT NULL COMMENT 'いつ見たか' , `exercises_type` TEXT NOT NULL COMMENT '演習の種類' , `video_id` INT NOT NULL COMMENT 'どの動画か' , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;";
echo $sql."<br>";
$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>Evaluation_myselfテーブル作成成功</p>');
}

echo "<br>";

$sql = "CREATE TABLE IF NOT EXISTS `teamdigicom_sunflower`.`evaluation_others` ( `id` INT NOT NULL AUTO_INCREMENT , `student_id` TEXT NOT NULL COMMENT '見られる側の学籍番号' , `watched_student_id` TEXT NOT NULL COMMENT '見る側の学籍番号' , `watched_at` DATETIME NOT NULL COMMENT 'いつ見たか' , `Exercises_type` TEXT NOT NULL COMMENT '演習の種類' , `video_id` INT NOT NULL COMMENT 'どの動画か' , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;";
echo $sql."<br>";
$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>Evaluation_othersテーブル作成成功</p>');
}

echo "<br>";

$sql = "CREATE TABLE IF NOT EXISTS `teamdigicom_sunflower`.`watch_teachersVideos` ( `id` INT NOT NULL AUTO_INCREMENT , `student_id` TEXT NOT NULL COMMENT '学籍番号' , `update_at` DATETIME NOT NULL COMMENT '見た日' , `exercises_type` TEXT NOT NULL COMMENT '演習の種類' , `video_number` INT NOT NULL COMMENT 'ビデオ番号' , PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;";
echo $sql."<br><br>";
$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>Evaluation_othersテーブル作成成功</p>');
}

echo "<br>";



//adminユーザ作成
$stu_num = "admin";
$mail = "not_mail";
$sch_name = "";
//adminのpassはadmin_d
$pass = password_hash(htmlspecialchars("admin_d", ENT_QUOTES),PASSWORD_DEFAULT);
$data_time = date("Y-m-d H:i:s");
$active = true;
$admin_Config = true;


// adminユーザが重複しないようにする------------------------
$sql = "INSERT IGNORE INTO user_tb(student_id,mail,password,school_name,is_active,created_at,update_at,is_administrator) VALUES('".$stu_num."','".$mail."','".$pass."','".$sch_name."','".$active."','".$data_time."','".$data_time."','".$admin_Config."');";
echo $sql."<br>";

$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
  echo "<p>admin_dユーザ登録失敗</p>";
}else{
  echo "<p>adminユーザ登録完了</p>";
}
echo "<br>";




//閲覧された動画テーブルを作成
$sql = "CREATE TABLE IF NOT EXISTS `teamdigicom_sunflower`.`watch_videos";

$sql2 = "` ( `id` INT NOT NULL AUTO_INCREMENT , `check_student` TEXT NOT NULL COMMENT 'チェック者' ,`checked_student` TEXT NOT NULL COMMENT 'チェックされた人' , `update_at` DATETIME NOT NULL COMMENT '見た日' , `exercises_type` TEXT NOT NULL COMMENT '演習の種類' ,";

$sql3 = " PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;";
$sql .= $sql2.$sql3;


echo $sql."<br>";

$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
	print('<p>watchテーブル作成成功</p>');
}

//閲覧された動画の秒数と評価を格納するテーブルの作成
//閲覧された動画テーブルのIDを元に作成するのでループとかはいらないよ！(頭がいいので正規化をしました)
$sql = "CREATE TABLE IF NOT EXISTS `teamdigicom_sunflower`.`watch_videos_times_exercisesItemsPoints` ( `id` INT NOT NULL , `time` INT NOT NULL , `exercisesItem_point` INT NOT NULL ) ENGINE = InnoDB;";

echo $sql."<br>";

$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
	print('<p>watchテーブル作成成功</p>');
}



echo "<br>";






//結果セットを解放
// $result->free();

// データベース切断
$mysqli->close();

?>
