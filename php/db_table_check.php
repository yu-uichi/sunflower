<?php




//require('./../../MySQL_connect.php');
require('MySQL_connect.php');


$sql = "SELECT * FROM ";



$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}else{
  print('');
}


//結果セットを解放
$result->free();

// データベース切断
$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>video1テーブル表示</title>
<meta charset="utf-8">
</head>
<body>
<h1>視聴回数表示ページ</h1>


</table>

</body>
</html>
