<?php
session_start();
if(isset($_SESSION['name'])){
  $_Student_num=$_SESSION['name'];
}else{
  echo "ログインしてください";
}

  //MySQL.phpでまぁいろいろ宣言している
  //require('./../../MySQL_connect.php');
  require('./../MySQL_connect.php');



  $pass_b = htmlspecialchars($_POST["before_password"], ENT_QUOTES);
  // $pass = password_hash(htmlspecialchars($_POST["after_password"], ENT_QUOTES),PASSWORD_DEFAULT);

  $sql = "SELECT * FROM users WHERE student_number IN('".$_Student_num."');";
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

  if(password_verify($pass_b,$row['password'])){
    echo "password OK<br>";

    //変更するパスワード
    $pass_a = password_hash(htmlspecialchars($_POST["after_password"], ENT_QUOTES),PASSWORD_DEFAULT);
    //Update
    $sql = "UPDATE users SET password = '".$pass_a."' WHERE ID IN('".$_Student_num."');";
    // echo $sql;
    $result = $mysqli -> query($sql);

    //クエリー失敗
    if(!$result) {
      // echo $mysqli->error;
      print('<p>変更できてナーイ</p><br>');
      // exit();
    }else{
      echo "パスワードの変更が完了しました";
    }

  }else{
    echo "パスワードが違います";
  }

  //結果セットを解放
  // $result->free();

  // データベース切断
  $mysqli->close();
?>

<input type="button" value="前のページへ戻る" onclick="location.href='./main_menu.php'">
