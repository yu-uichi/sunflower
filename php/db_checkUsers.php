<?php



 require('MySQL_connect.php');
//require('./../../MySQL_connect.php');


$sql = "SELECT * FROM `users`";

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
foreach($rows as $row){
?>
<!-- <tr> -->

<tr>
	<?php echo "ID : ".$row['id']; ?>,
	<?php echo "UserName : ".$row['student_number']; ?>,
	<?php echo $row['mail']; ?>,
	<?php echo $row['password']; ?>,
	<?php echo $row['school_name']; ?>,
	<?php echo $row['is_active']; ?>,
	<?php echo $row['created_at']; ?>,
	<?php echo $row['update_at']; ?>,
	<?php echo $row['is_administrator']; ?>,

  <br>
</tr>
<?php
}
?>

</table>

</body>
</html>
