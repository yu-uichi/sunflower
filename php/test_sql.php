<?php
//データベース接続
$server = 'localhost';
$userName = 'root';
$password = 'root';
$dbName = "teamdigicom_sunflower";

$mysqli = new mysqli($server,$userName,$password,$dbName);

if ($mysqli->connect_error){
	echo $mysqli->connect_error;
	exit();
}else{
	$mysqli->set_charset("utf-8");
}


$sql = "INSERT INTO count_viewing_videos1(ID, year, month, day, No1, No2, No3, No4, No5, No6, No7, No8, No9, No10, No11,No12,No13,No14,No15,No16,No17,No18,No19,No20,No21,No22,No23) VALUES(1111,2016,10,10,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1)";


$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('<p>作成成功</p>');
}

//結果セットを解放
$result->free();

// データベース切断
$mysqli->close();

?>
