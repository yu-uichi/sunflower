<?php
  session_start();
  if(isset($_SESSION['name'])){
    $_Student_num=$_SESSION['name'];
  }else{
    echo "ログインしてください";
    exit();
  }
  //ディレクトリ名
  $dir_path = './../upload/movies/'.$_Student_num."/";
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
    exit();
  }
  // debug
  // var_dump($movies);
  // exit();
?>





<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>tst</title>
  <style type="text/css">

  </style>
  <!-- CSV -->
  <script type="text/javascript" src="./../js/read_evaluation.js"></script>
   <!-- ボタンが押されたとき -->
  <!-- <script type="text/javascript" src="./../js/playback_button.js"></script> -->

  <script type="text/javascript">
    //動画変更するための関数------
    // var unko;
    function movie_change(get_movie_name){
      //動画パス記述
      var path = "./../upload/movies/"+User+"/";

      //動画のsrcをそれぞれ変更していく
      //まず、ボタンを押された動画名を取得
      var movie_slice = get_movie_name.split("_");
      //1,2,3に分割し、それぞれsrcに入れていく
      //1はそのまま入れれる
      document.getElementById("video1").src = path+get_movie_name;

      //2,3はけつの部分変更
      document.getElementById("video2").src = path+movie_slice[0]+"_"+movie_slice[1]+"_"+movie_slice[2].replace( /1/g , "2" );
      // console.log(movie_slice[0]+"_"+movie_slice[1]+"_"+movie_slice[2].replace( /1/g , "2" ));
      document.getElementById("video3").src = path+movie_slice[0]+"_"+movie_slice[1]+"_"+movie_slice[2].replace( /1/g , "3" );
    };
  </script>

</head>
<body>
  <hr>
  <!-- 動画と評価部分 -->
    <table border="1" width="100%" height="200">
      <tr>
        <!-- ビデオ部分 -->
        <td>
          <div id="videoBox">
            <video width="" height="" id="video1" style="margin:0px 0px 4px 0px;" src=""></video>
            <video width="" height="" id="video2" style="margin:0px 0px 4px 0px;" src=""></video>
            <video width="" height="" id="video3" style="margin:0px 0px 4px 0px;" src=""></video>
          </div>

          <!-- スライダー -->

    			<!-- <div id="slider"></div> -->
    			<div id="slider_box">
    				<div id="resInsertBefore"></div>
    				<!-- <input type="image" id="samune" src="./../img/seek_not.png" style="width:800px; height:29px;" margin="-30px"> -->
    				<input type="range" id="edit_02_slider" style="width:800px" min="0" max="" step="0.00001" value="0.0"></input>
    			</div>
          <div>
            <!--  	ボタン			-->
      			<input type="image" onclick="play_video()" src="./../img/start_button.png" style="width:40px; height:40px; margin:0px 10px 10px 0px;" title="再生">
      			<input type="image" onclick="pause_video()" src="./../img/stop_button.png" style="width:40px; height:40px; margin:0px 10px 10px 0px;" title="一時停止">
      			<input type="image" onclick="stop_video()" src="./../img/stop_button2.png" style="width:40px; height:40px; margin:0px 30px 10px 0px;" title="停止">

      			<img src="./../img/volumu_button.png" style="width:40px; height:40px; margin:0px 5px 50px 0px;">
      			<input type="range" id="volume_slider" style="width:70px; padding:20px 0px; display:inline" min="0" max="1.0" step="0.00001" value="1.0"></input>


      			<!-- <span>ループ:<input type="checkbox" id="input_02_loop"></span> -->
      			<!-- <input type="image" onclick="back_video()" src="./../img/back_button.png" style="width:130px; height:50px; margin:0px 10px 10px 0px;" title="前動画">
      			<input type="image" onclick="next_video()" src="./../img/next_button.png" style="width:130px; height:50px; margin:0px 10px 10px 0px;" title="次動画">
      			<input type="image" onclick="reload()" src="./../img/zure.png" style="width:130px; height:50px; margin:0px 10px 10px 0px;" title="次動画"> -->
          </div>
        </td>
        <!-- 評価部分 -->
        <td>
          <!-- 評価CSV読み込み -->
          <form name="Myform" action="./../php/send_SQL_playback.php" method="POST">
            <div id="hyouji"></div>
            <div id="send_time"></div>
            <button class="pull-right" class="btn btn-default" type="submit" name="Submit" id="Submit" value="送信">評価を完了する
          </form>
        </td>
      </tr>
    </table>
    <!-- 動画一覧 -->
    <table border="1" width="100%" id="movie">
      <tbody>
        <tr>
          <td>


            <script>
              //ビデオの解像度決定
              var video1 = document.getElementById("video1");
              var video2 = document.getElementById("video2");
              var video3 = document.getElementById("video3");

              var v_width = 1920;
              var v_height = 1080;
              var v_size = 0.2;

              video1.width = v_width * v_size;
              video1.height = v_height * v_size;
              video2.width = v_width * v_size;
              video2.height = v_height * v_size;
              video3.width = v_width * v_size;
              video3.height = v_height * v_size;


              //ユーザ名取得
              var User = <?php echo json_encode($_Student_num, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
              // 動画取得
              var array = <?php echo json_encode($movies, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
              var files = '<h3>撮影した自身の映像一覧(クリックすることで表示されます)</h3><br>';
              //日付
              var y='', m='', d='', h='', mi='';
              //動画の種類
              // var movie_type = '';

              // Object.keys(array).length ->配列の長さ
              for(i=0;i<Object.keys(array).length;i++){
                var movie_slice = array[i].split("_");
                // console.log(movie_slice[0]);
                // console.log(movie_slice[1]);
                y = movie_slice[1].slice(0,4);
                m = movie_slice[1].slice(4,6);
                d = movie_slice[1].slice(6,8);
                h = movie_slice[1].slice(8,10);
                mi = movie_slice[1].slice(10,12);
                //動画の種類
                // switch (movie_slice[0]) {
                //   case "bed1":
                //     movie_type = "ボディメカニクスを活用したベッドメーキング";
                //     break;
                //   case "bed2":
                //     movie_type = "臥症患者のベッドメーキング";
                //     break;
                //   case "Sterilization1":
                //     movie_type = "滅菌手袋の着脱編";
                //     break;
                //   case "Sterilization2":
                //     movie_type = "滅菌状態の確認と取り扱い編";
                //     break;
                //   case "Sterilization1":
                //     movie_type = "無菌操作・消毒綿球の作り方編";
                //     break;
                //   case "injection1":
                //     movie_type = "6R編";
                //     break;
                //   case "injection2":
                //     movie_type = "注射準備編";
                //     break;
                //   case "injection3":
                //     movie_type = "筋肉・皮下注射";
                //     break;
                //   default:
                // }

                //movie_slice[2]:動画番号が1のぶんだけ表示
                // console.log(movie_slice[2]);
                if(movie_slice[2]=='1.mp4'){
                    // files = files +'<label><input type="button" id="'+array[i]+'"  value="'+ User +'" onclick="getId(this.id)"><\/label><label>撮影日時:'+y+'年'+m+'月'+d+'日'+h+'時'+mi+'分<\/label><br>';
                    files = files +'<label><input type="button" id="'+array[i]+'"  value="'+ User +'" onclick=movie_change("'+array[i]+'")><\/label><label>撮影日時:'+y+'年'+m+'月'+d+'日'+h+'時'+mi+'分<\/label><br>';
                    // console.log(array[i]);
                }
              }
              document.getElementById('movie').innerHTML = files;

              //ボタン---------------------------------
              function play_video(){
              	video1.play();
              	video2.play();
                video3.play();
                video2.muted = true;
                video3.muted = true;
              };

              function pause_video(){
              	video1.pause();
              	video2.pause();
                video3.pause();
              };

              function stop_video(){
              	//0病処理とかぶらないようにしている
              	video1.currentTime = 0.0001;
              	video1.pause();
              	video2.currentTime = 0;
              	video2.pause();
                video3.currentTime = 0;
              	video3.pause();
              };


              //ボタン---------------------------------

              // 各エレメントを取得--------------------------
              var element_slider = document.getElementById("edit_02_slider");
              var element_vol_slider = document.getElementById("volume_slider");

              // イベントハンドラ
              // var event = "click" ;

              (function (){
              	// スライダー変更時に実行されるイベント--------------------------
              	element_slider.onchange = function (){
              		video1.currentTime = this.value;
              		video2.currentTime = this.value;
                  video3.currentTime = this.value;
              	};
              	//ボリューム変更--------------------------
              	element_vol_slider.onchange = function (){
                  video1.volume = this.value;
              		// video2.volume = this.value;
                  // video3.volume = this.value;
              	};

              })();
              // ビデオ秒数によってスライダーを変化--------------------------
              video1.addEventListener("timeupdate",function (e){
              	// スライダーを更新
              	element_slider.max = video1.duration;
              	element_slider.value = video1.currentTime;
              },false);

              //ラジオボタンをおした時、その押されたボタンを取得して時間を配列に入れていく
              var time_check_array = [""];
              function time_check(radio_id){
                time_check_array[radio_id] = video1.currentTime;
                console.log(time_check_array[radio_id]);

                //時間送信用の変数を用意
                var time_element = document.createElement('input');

                //同じnameの要素があったら、それを削除後要素追加、なければそのまま要素追加
                var child = document.getElementsByName("time_"+radio_id);
                if(child[0]){
                  // console.log("ある");
                  document.getElementById('send_time').removeChild(child[0]);

                  time_element.type = 'hidden';
                  time_element.name = "time_"+radio_id;
                  time_element.value = time_check_array[radio_id];
                  document.getElementById('send_time').appendChild(time_element);
                }else{
                  // console.log("ない");
                  time_element.type = 'hidden';
                  time_element.name = "time_"+radio_id;
                  time_element.value = time_check_array[radio_id];
                  document.getElementById('send_time').appendChild(time_element);
                }

              }




            </script>


          </td>
        </tr>
      </tbody>
    </table>
