<?php
  session_start();
  if(isset($_SESSION['name'])){
    $_Student_num=$_SESSION['name'];
  }else{
    echo "ログインしてください";
  }
?>

<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>tst</title>
    <style type="text/css">

    </style>
    <!-- CSV -->
    <script type="text/javascript" src="./../js/read_evaluation_others.js"></script>
     <!-- ボタンが押されたとき -->
    <script type="text/javascript" src="./../js/playback_button_others.js"></script>
  </head>
  <body>
    <hr>
    <!-- 動画と評価部分 -->
      <table border="1" width="100%" height="200">
        <tr>
          <!-- ビデオ部分 -->
          <td>
            <video width="80%" height="100%" id="video2" style="margin:0px 0px 4px 0px;" autoplay="true" src=""></video>
          </td>
          <!-- 評価部分 -->
          <td>
            <!-- 評価CSV読み込み -->
            <form name="Myform2" action="./../php/send_SQL_playback.php" method="POST">
              <div id="hyouji2"></div>
              <button class="pull-right" class="btn btn-default" type="submit" name="Submit2" id="Submit2" value="送信">評価を完了する
            </form>
          </td>
        </tr>
      </table>
      <!-- 動画一覧 -->
      <table border="1" width="100%" id="movie2">
        <tbody>
          <tr>
            <td>
              <h2>ここに動画を閲覧する他学生の学籍番号を入力してください</h2>
              <form name="Myform3" id="Myform3" action="read_directory_others.php" method="POST">
                <input type="text" name="User" id="User">
                <button class="btn btn-default" type="submit" name="Submit" id="Submit2" value="送信">学籍番号を入力したらここを押してください</button>
                <div id ="others" class="others"></div>

              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </hr>
  </body>
</html>

<script>
  $('#Myform3').submit(function(event) {
    // HTMLでの送信をキャンセル
    event.preventDefault();

    // 操作対象のフォーム要素を取得
    var $form = $(this);

    // 送信ボタンを取得
    var $button = $form.find('button');

    // 送信
    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: $form.serialize(),
        timeout: 10000,  // 単位はミリ秒

        // 送信前
        beforeSend: function(xhr, settings) {
            // ボタンを無効化し、二重送信を防止
            $button.attr('disabled', true);
        },
        // 応答後
        complete: function(xhr, textStatus) {
            // ボタンを有効化し、再送信を許可
            $button.attr('disabled', false);
        },

        // 通信成功時の処理
        success: function(data, textStatus, xhr) {
            // 入力値を初期化
            $form[0].reset();
            // alert(data);
            var a = document.getElementById("others");
            a.innerHTML = data;
        },

        // 通信失敗時の処理
        error: function(xhr, textStatus, error) {
            alert('NG...');
        }
    });
  });
</script>
