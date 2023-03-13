<?php

  //MySQL.phpでまぁいろいろ宣言している
  require('MySQL_connect.php');
  //require('./../../MySQL_connect.php');



  $stu_num1 = htmlspecialchars($_POST["first_student_number"],ENT_QUOTES);
  $stu_num2 = htmlspecialchars($_POST["last_student_number"],ENT_QUOTES);
  //学籍番号が数字以外なら拒否
  if(!is_numeric($stu_num1) && !is_numeric($stu_num2)){
    print('<p>学籍番号を数字で入力してください</p><br>');
    exit();
  }

  //7桁か調べる
  if(!preg_match('/^([0-9]{7})$/', $stu_num1) && !preg_match('/^([0-9]{7})$/', $stu_num2)){
    echo "7桁で番号を入力してください";
    exit();
  }else{
    // echo "ok";
  }

  //学籍番号を何番まで登録するかの計算
  //1670001から1670010の10人なら
  //1670010 - 1670001 = 9 (+ 1)してあげる
  $stu_any = $stu_num2 - $stu_num1 + 1;
  // echo $stu_any;
  for($i = 0;$i < $stu_any;$i++){
    //登録する学籍番号
    //1670001から + iずつしてあげる
    $stu_reg = $stu_num1+$i;
    //パスワードは学籍番号
    $pass = password_hash(htmlspecialchars($stu_reg, ENT_QUOTES),PASSWORD_DEFAULT);

    // $sql = "INSERT INTO user(ID, password) VALUES('".$stu_reg."','".$pass."');";

    $mail = "";
    $sch_name = "";
    $data_time = date("Y-m-d H:i:s");
    $active = true;

    $sql = "INSERT INTO users(student_number,mail,password,school_name,is_active,created_at,update_at) VALUES('".$stu_reg."','".$mail."','".$pass."','".$sch_name."','".$active."','".$data_time."','".$data_time."');";

    $result = $mysqli -> query($sql);
    //クエリー失敗
    if(!$result) {
      // echo $mysqli->error;
      print('<p>学籍番号が重複しているか、入力エラーです</p><br>');
      // exit();
    }else{
      // print('<p>ユーザ登録完了</p><br>');
      // print('<p>ユーザ名(学籍番号)とパスワードを忘れないようにしてください。</p>');

      //ユーザごとの動画保存フォルダの作成
      $directory_path = "./../upload/movies/".$stu_reg;

      //「$directory_path」で指定されたディレクトリを作成する
      if(mkdir($directory_path)){
          //作成に成功した時の処理
          // echo "作成に成功しました";
      }else{
          //作成に失敗した時の処理
          echo "作成に失敗しました";
      }
    }
  }
  print('<p>ユーザ登録完了</p><br>');
  print('<p>パスワードは学籍番号と同じです。後ほど変更してください。</p>');
  //結果セットを解放
  // $result->free();

  // データベース切断
  $mysqli->close();
?>

<input type="button" value="前のページへ戻る" onclick="location.href='./../html/register_master.html'">
