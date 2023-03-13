<?php



require('MySQL_connect.php');
// require('./../../MySQL_connect.php');


$sql = "SELECT `ID` , count(*) As `count` FROM new_count_viewing_videos GROUP BY `ID` ORDER BY `count` DESC";


$sql = "SELECT * FROM new_count_viewing_videos";




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

//連想配列で取得
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$rows[] = $row;
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

レコード件数：<?php echo $row_count; ?>
<br>
<?php

$arr = [];

foreach($rows as $row){
?>
<!-- <tr> -->
<?php
	if($row['ID'] != "1111111" && $row['ID'] != "1234567" && $row['ID'] != "admin"){
		echo $row['ID'];
		echo ",";
		echo $row['videos'];
		echo "-";
		echo $row['videoNum'];
		echo "<br>";


	}
?>





<?php
}
?>

</table>

</body>
</html>
