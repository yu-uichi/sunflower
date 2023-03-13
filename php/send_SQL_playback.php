<?php
  session_start();
  if(isset($_SESSION['name'])){
    $_Student_num=$_SESSION['name'];
  }else{
    echo "ログインしてください";
    exit();
  }

  //MySQL.phpでまぁいろいろ宣言している
  require('MySQL_connect.php');
  //require('./../../MySQL_connect.php');


  //評価項目数
  $num = $_REQUEST['type_num'];
  //ラジオボタンと評価時間の結果取得
  $exc = array();
  $times = array();
  for($i = 0;$i < $num;$i++){
    if(isset($_REQUEST['q'.$i])){
      $exc[$i] = $_REQUEST['q'.$i];
      $times[$i] = $_REQUEST['time_q'.$i];
    }
  }

  date_default_timezone_set('Asia/Tokyo');
  $data_time = date("Y-m-d H:i:s");
  $ex_type = "注射演習";

  //データがなければINSERT
  $sql = "INSERT INTO `watch_videos` (`check_student`,`checked_student`,`update_at`,`exercises_type`) values (\"" .$_Student_num . "\",\"".$_Student_num."\",\"".$data_time."\",\"".$ex_type."\");";

  // echo $sql;
  $result = $mysqli -> query($sql);
  if(!$result) {
    echo $mysqli->error;
    // print('<p>学籍番号が重複しているか、入力エラーです</p><br>');
    // exit();
  }else{
    print('<p>登録完了</p><br>');
  }

  //前のidを参照にして時間と評価内容を登録
  $watch_id = $mysqli->insert_id;
  // echo $watch_id;

  for($i = 0;$i < $num;$i++){
    if(isset($_REQUEST['q'.$i])){
      $sql = "INSERT INTO `watch_videos_times_exercisesItemsPoints` (`id`,`time`,`exercisesItem_point`) values (\"" .$watch_id . "\",\"".$times[$i]."\",\"".$exc[$i]."\");";

      $result = $mysqli -> query($sql);
      if(!$result) {
        echo $mysqli->error;
        // print('<p>学籍番号が重複しているか、入力エラーです</p><br>');
        // exit();
      }else{
        // print('<p>登録完了</p><br>');
      }
    }
  }


  $close_flag = mysqli_close($mysqli);
  if ($close_flag){
    // print('<p>切断に成功しました。</p>');
  }




?>
<html>
  <head>
    <title>送信完了</title>
  </head>
  <body>
    評価項目は、<font color="#FF0000"><b><?= $num; ?></b></font>個です。
    <br>
    <?php
      $i = 1;
      foreach ($exc as $value) {
          echo "項目".$i."の点数は".$value."点です。";
          $i++;
          if($i%3==0){
            echo "<br>";
          }
      }
      echo "<br>";
      $i = 1;
      foreach ($times as $value) {
          echo "項目".$i."の時間は".$value."秒です。";
          $i++;
          if($i%3==0){
            echo "<br>";
          }
      }
      unset($value); // 最後の要素への参照を解除します
    ?>
    <a href="./main_menu.php">戻る</a>
  </body>
</html>
