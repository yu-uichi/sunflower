<?php

  //MySQL.phpでまぁいろいろ宣言している
  require('MySQL_connect.php');
  //require('./../../MySQL_connect.php');

  $stu_num = htmlspecialchars($_POST["student_number"],ENT_QUOTES);
  //学籍番号が数字以外なら拒否
  // if(!is_numeric($stu_num)){
  //   print('<p>学籍番号を数字で入力してください</p><br>');
  // }

  $pass = htmlspecialchars($_POST["password"], ENT_QUOTES);

  $sql = "SELECT * FROM users WHERE student_number IN('".$stu_num."');";
  // echo $sql;

  $result = $mysqli -> query($sql);
  //クエリー失敗
  if(!$result) {
    echo $mysqli->error;
    // print('<p>登録されていな学籍番号です。</p><br>');
    // exit();
  }else{
    // print('<p>ユーザがいます</p><br>');
  }
  //連想配列で取得
  $get_bool;
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
  	$rows[] = $row;
    if(empty($row['student_number'])){
      $get_bool = false;
    }else{
      $get_bool = true;
    }
  }
  if($get_bool){
    foreach($rows as $row){
    }
  }

  if(empty($row['student_number'])) {
    // echo $mysqli->error;
    print('<p>登録されていない学籍番号です。</p><br>');
    // exit();
  }else{
    // print('<p>ユーザがいます</p>');
  }

  if(password_verify($pass,$row['password'])){
    // echo "password OK";
    session_start();
    $_SESSION['name'] = $_POST["student_number"];
    // header('Location: ./video1.php');
    header('Location: ./main_menu.php');
    exit();
  }else{
    echo "パスワードが違います";
  }

  //結果セットを解放
  $result->free();

  // データベース切断
  $mysqli->close();


?>

<input type="button" value="前のページへ戻る" onclick="location.href='../index.php'">
