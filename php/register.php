<?php
  //MySQL.phpでまぁいろいろ宣言している
  // require('MySQL_connect.php');
  require('./../MySQL_connect.php');

  // ini_set( 'display_errors', 1 );


  $stu_num = htmlspecialchars($_POST["student_number"],ENT_QUOTES);
  //学籍番号が数字以外なら拒否
  // if(!is_numeric($stu_num)){
  //   print('<p>学籍番号を数字で入力してください</p><br>');
  // }

  $mail = htmlspecialchars($_POST["mail"],ENT_QUOTES);
  $sch_name = htmlspecialchars($_POST["school_name"],ENT_QUOTES);
  $pass = password_hash(htmlspecialchars($_POST["password"], ENT_QUOTES),PASSWORD_DEFAULT);
  $data_time = date("Y-m-d H:i:s");
  $active = true;

  $sql = "INSERT INTO users(student_number,mail,password,school_name,is_active,created_at,update_at) VALUES('".$stu_num."','".$mail."','".$pass."','".$sch_name."','".$active."','".$data_time."','".$data_time."');";
  // echo $sql;

  $result = $mysqli -> query($sql);
  //クエリー失敗
  if(!$result) {
    // echo $mysqli->error;
    print('<p>学籍番号が重複しているか、入力エラーです</p><br>');
    // exit();
  }else{
    print('<p>ユーザ登録完了</p><br>');
    print('<p>ユーザ名(学籍番号)とパスワードを忘れないようにしてください。</p>');

    //ユーザごとの動画保存フォルダの作成
    $directory_path = "./../upload/movies/".$stu_num;

    //「$directory_path」で指定されたディレクトリを作成する
    if(mkdir($directory_path)){
        //作成に成功した時の処理
        chmod($directory_path,0777);
        echo "フォルダの作成に成功しました";
    }else{
        //作成に失敗した時の処理
        echo "フォルダの作成に失敗しました。フォルダがすでに存在します。";
    }
  }

  //結果セットを解放
  // $result->free();

  // データベース切断
  $mysqli->close();
?>
<html>
  <input type="button" value="前のページへ戻る" onclick="location.href='../index.php'">
</html>
