<?php
//データベース接続
$server = "mysql811a.xserver.jp";
$userName = "teamdigicom_sun";
$password = "3FloWer3";
$dbName = "teamdigicom_sunflower";

$mysqli = new mysqli($server,$userName,$password,$dbName);

if ($mysqli->connect_error){
	echo $mysqli->connect_error;
	exit();
}else{
	$mysqli->set_charset("utf-8");
}

//データベース接続
$server = "mysql811a.xserver.jp";
$userName = "teamdigicom_sun";
$password = "3FloWer3";
$dbName = "teamdigicom_sunflower";

$mysqli = new mysqli($server,$userName,$password,$dbName);

if ($mysqli->connect_error){
	echo $mysqli->connect_error;
	exit();
}else{
	$mysqli->set_charset("utf-8");
}
$sql = "CREATE TABLE new_count_viewing_videos(`ID` TEXT, `year` INT,`month` INT,`day` INT, `videos` INT,`videoNum` INT);";


$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>作成成功</p>');
}

//レコード件数
$row_count = $result->num_rows;


//結果セットを解放
$result->free();

// データベース切断
$mysqli->close();

?>

$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>作成成功</p>');
}

//レコード件数
$row_count = $result->num_rows;


//結果セットを解放
$result->free();

// データベース切断
$mysqli->close();

?>
