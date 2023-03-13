<?php




//データベース接続
// $server = "mysql2105.xserver.jp";
// $userName = "teamdigicom_sun";
// $password = "3FloWer3";
// $dbName = "teamdigicom_sunflower";

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


$sql = "CREATE TABLE user(`ID` INT UNIQUE,`password` TEXT);";
echo $sql."<br><br>";


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
