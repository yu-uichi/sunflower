<?php
    session_start();
?>

<html>
  <head>
    <title>logout</title>
  </head>
  <body>

    <?php
        // print('セッション変数の一覧を表示します。<br>');
        // print_r($_SESSION);
        // print('<br>');
        //
        // print('セッションIDを表示します。<br>');
        // print($_COOKIE["PHPSESSID"].'<br>');
        //
        // print('<p>ログアウトします</p>');

        //$_SESSION = array();で初期化
        $_SESSION = array();

        // if (isset($_COOKIE["PHPSESSID"])) {
        //     setcookie("PHPSESSID", '', time() - 1800, '/');
        // }

        session_destroy();

    ?>
    ログアウトが完了しました。
  <p>
    <a href="./../index.php">ログインメニューに戻る</a>
  </p>

  </body>
</html>
