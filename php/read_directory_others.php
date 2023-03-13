<?php
  //ディレクトリ名
  if(isset($_POST['User'])){
    $user = $_POST['User'];
    // echo $user;
    // $user = "1234567";
    $dir_path = './../upload/movies/'.$user."/";
    // echo $dir_path;
    // echo $dir_path;
    // カレントディレクトリの全てのエントリを一覧する。
    if ($handle = opendir($dir_path)) {
      while (false !== ($entry = readdir($handle))) {
        //拡張子しゅとく
        $ext = pathinfo($entry, PATHINFO_EXTENSION);
        //. および .. は覗き、mp4だけ格納
        if ($entry != "." && $entry != ".." && $ext == 'mp4') {
            // 配列に格納
            $movies[] = $entry;
        }
      }
      closedir($handle);
    }

    if(empty($movies[0])){
      // var_dump($movies);
      echo "<h3>動画がアップロードされていません</h3>";
      echo "nai";
      exit();
    }else{
      //もしムービーがあれば
      // echo $user;
      // var_dump($movies);
      //movieの中身を取り出し
      foreach ($movies as $value) {
        //文字列操作して、日付とタグを分ける
        $type_ymd = explode("_",$value);
        $y = substr($type_ymd[1],0,4);
        $m = substr($type_ymd[1],4,2);
        $d = substr($type_ymd[1],6,2);
        // echo "Y: ".$y."<br>";
        // echo "M: ".$m."<br>";
        // echo "D: ".$d."<br>";

        $movie_type = '';
        switch ($type_ymd[0]) {
          case "bed1":
            $movie_type = "ボディメカニクスを活用したベッドメーキング";
            break;
          case "bed2":
            $movie_type = "臥症患者のベッドメーキング";
            echo $movie_type;
            break;
          case "Sterilization1":
            $movie_type = "滅菌手袋の着脱編";
            echo $movie_type;
            break;
          case "Sterilization2":
            $movie_type = "滅菌状態の確認と取り扱い編";
            break;
          case "Sterilization1":
            $movie_type = "無菌操作・消毒綿球の作り方編";
            break;
          case "injection1":
            $movie_type = "6R編";
            break;
          case "injection2":
            $movie_type = "注射準備編";
            break;
          case "injection3":
            $movie_type = "筋肉・皮下注射";
            break;
          default:
        }
        echo "<input type='button' id='$value' value='$movie_type' onclick='getId2(this.id)'>";
        echo "<label>撮影日時: $y 年 $m 月 $d 日</label><br>";
      }

    }
    // debug
    // var_dump($movies);
    // exit();
  }else{
    $user = "";
  }
?>
