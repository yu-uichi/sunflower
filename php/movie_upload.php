<?php
session_start();
if(isset($_SESSION['name'])){
  $_Student_num=$_SESSION['name'];
}else{
  echo "ログインしてください";
}
// ファイル名を取得して、ユニークなファイル名に変更
//演習の種類
// $radio = $_REQUEST["Exercises_type"];

//ちゃんと演習が選択されていれば
if(isset($_REQUEST["Exercises_type"])){
  $radio = $_REQUEST["Exercises_type"];
  $file_name = $_FILES['upfile']['name'];
  $uniq_file_name = $radio . "_" . date("YmdHis") . ".mp4";



  // 仮にファイルがアップロードされている場所のパスを取得
  $tmp_path = $_FILES['upfile']['tmp_name'];


  // 保存先のパスを設定
  $upload_path = './../upload/movies/'.$_Student_num."/";


  if (is_uploaded_file($tmp_path)) {
    // 仮のアップロード場所から保存先にファイルを移動
    if (move_uploaded_file($tmp_path, $upload_path . $uniq_file_name )) {
      // ファイルが読出可能になるようにアクセス権限を変更
      // chmod($upload_path . $uniq_file_name .$_Student_num, 0644);

      echo "アップロードが完了しました。";
      echo "<br><a href='main_menu.php'><- TOPへ戻る</a>";
    } else {
      echo "Error:アップロードに失敗しました。";
    }
  } else {
    echo "動画アップロードに失敗しました。動画が選択されているか確認してください。";
    echo "<br><a href='main_menu.php'><- TOPへ戻る</a>";
  }
}else{
  echo "演習種目を選択してください";
  echo "<br><a href='main_menu.php'><- TOPへ戻る</a>";
}


?>
