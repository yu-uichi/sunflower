<html>
<div class="container">
  <div class = "pcUser">
    <p id="title" style="background-color:#ffcc99" >CSVエラー</p>

    <br>

    <div class="video_container">
      <div class="video_box">
        <video width="355" height="200" id="video_01" style="margin:0px 0px 4px 0px;" autoplay="true"></video>
        <br>
        動画拡大:<input type="checkbox" id="input_01_big" style="width:355px;">
      </div>
        <div class="video_box">
        <video width="355" height="200" id="video_02" style="margin:0px 0px 4px 0px;" autoplay="true"></video>
        <br>
        動画拡大:<input type="checkbox" id="input_02_big" style="width:355px;">
      </div>
      <div class="video_box">
        <video width="355" height="200" id="video_03" style="margin:0px 0px 4px 0px;" autoplay="true"></video>
        <br>
        動画拡大:<input type="checkbox" id="input_03_big">
      </div>
    </div>

    <img src="" width="0" height="0" alt="注目点がある場合、表示されます" id="tyumoku1">
    <img src="" width="0" height="0" alt="注目点がある場合、表示されます" id="tyumoku2">
    <!-- <img src="" width="267" height="150" alt="画像" id="tyumoku2"> -->

    <p id="csv1" style="background-color:#ffcc99">CSVエラー</p>

    <!-- スライダー -->

    <!-- <div id="slider"></div> -->
    <div id="slider_box">
      <div id="resInsertBefore"></div>
      <!-- <input type="image" id="samune" src="img/seek_not.png" style="width:800px; height:29px;" margin="-30px"> -->
      <input type="range" id="edit_02_slider" style="width:800px" min="0" max="1.0" step="0.00001" value="0.0"></input>
    </div>



    <!--  	ボタン			-->
    <input type="image" onclick="play_video()" src="img/start_button.png" style="width:40px; height:40px; margin:0px 10px 10px 0px;" title="再生">
    <input type="image" onclick="pause_video()" src="img/stop_button.png" style="width:40px; height:40px; margin:0px 10px 10px 0px;" title="一時停止">
    <input type="image" onclick="stop_video()" src="img/stop_button2.png" style="width:40px; height:40px; margin:0px 30px 10px 0px;" title="停止">

    <img src="img/volumu_button.png" style="width:40px; height:40px; margin:0px 5px 50px 0px;">
    <input type="range" id="volume_slider" style="width:70px; padding:20px 0px; display:inline" min="0" max="1.0" step="0.00001" value="1.0"></input>


    <!-- <span>ループ:<input type="checkbox" id="input_02_loop"></span> -->
    <input type="image" onclick="back_video()" src="img/back_button.png" style="width:130px; height:50px; margin:0px 10px 10px 0px;" title="前動画">
    <input type="image" onclick="next_video()" src="img/next_button.png" style="width:130px; height:50px; margin:0px 10px 10px 0px;" title="次動画">
    <input type="image" onclick="reload()" src="img/zure.png" style="width:130px; height:50px; margin:0px 10px 10px 0px;" title="次動画">


    <ul id="DETE">
      <li id="now"></li>
      <li id="all"></li>
    </ul>
    <br>


    <div style="display:none">
      <audio id = "audio" preload ="auto"/>
        <!-- <source src="./narration1/1.mp3"> -->
      </audio>
    </div>
  </div>
</div>

<!-- BGM -->
<audio id="bgm" autoplay loop></audio>


<!-- フッター -->
<!-- <div id="footer">
  Copyright © 2016-2017 Shubun University          create by Aichi Institute of Technology Sawano-lab
</div> -->


<!-- プラグイン -------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="bootstrap/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="bootstrap/docs/dist/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $(".navbar-nav li a").click(function(event) {
      $(".navbar-collapse").collapse('hide');
    });
  });
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- プラグイン -------------------------------------------->


</body>



<script type="text/javascript">
//グローバル変数
//学籍番号取得
var Student_num = "<?php echo $_Student_num ?>";
document.getElementById('st_num').innerHTML = "ようこそ"+Student_num+"さん。";
//何番目のビデオか
// var video_number = window.location.search.substring(32,33);
video_number = 1;
console.log("number:::"+video_number);
//ビデオがいくつあるかの変数
var video_counter=23;
//現在のフォルダ
var folder_count=1;
//csv読み込み用変数
var csv_1 = document.getElementById('csv1').innerHTML = "a";
//video変数
var video = document.getElementById("video_01");
var video2 = document.getElementById("video_02");
var video3 = document.getElementById("video_03");
video.volume = 0;
video2.volume = 0;
video3.volume = 0;
//bgm
document.getElementById("bgm").src = "ongen"+video_number+".mp3";
//画像表示部分
document.getElementById("tyumoku1").src = "videos_img"+video_number+"/tyumoku" + folder_count+".png";
document.getElementById("tyumoku2").src = "videos_img"+video_number+"/tyumoku" + folder_count+"-2.png";
//BGM
var media = document.getElementById("bgm");
media.volume = 0.2;
//どこをどれだけ見たかのカウント
var watched_count=[];
//初期化
var watched_bool = false;

video_change();
//
//zure
var zure=[];
//読み込み1回目だけ行う例外処理
var read_1 = true;




//PCのユーザのみ見せる
var $ua = navigator.userAgent;
$(function(){
//スマホユーザはなにもしない
  if($ua.indexOf('iPhone') > 0 || $ua.indexOf('iPad') > 0 || $ua.indexOf('iPod') > 0 || $ua.indexOf('android') > 0 || $ua.indexOf('BlackBerry') > 0 || $ua.indexOf('windows Phone') > 0 || $ua.indexOf('NOKIA') > 0 || /Mobile.*Firefox/.test($ua)){
  } else {//PCユーザのみ見せる
      $('.pcUser').show();
  }
});








var narration = document.getElementById("audio");
// narration.src = Audio_list[0];
var audio_ = "./narration"+video_number+"/"+folder_count+".MP3";
// console.log("ahfqofoq    "+audio_);
narration.src = audio_;
narration.load();
narration.play();


//tabが押された時に別の動画に変更する
function tab_change(){
video_change();
element_slider.value = 0;
getCSV1();
getCSV3();
video.currentTime = 0;
video2.currentTime = 0;
video3.currentTime = 0;
read_1=true;
folder_count=1;
getCSV4();
video_change();
narration.currentTime = 0;
narration_system();
document.getElementById("tyumoku1").src = "videos_img"+video_number+"/tyumoku" + folder_count+".png";
document.getElementById("tyumoku2").src = "videos_img"+video_number+"/tyumoku" + folder_count+"-2.png";
console.log("number"+video_number);

}
function video_choice1(){
video_number = 1;
video_counter = 23;
tab_change();
}
function video_choice2(){
video_number = 2;
video_counter = 45;
tab_change();
}



function video_choice3(){
video_number = 3;
video_counter = 6;
tab_change();
}

function video_choice4(){
video_number = 4;
video_counter = 20;
tab_change();
}

function video_choice5(){
video_number = 5;
video_counter = 23;
tab_change();
}

function video_choice6(){
video_number = 6;
video_counter = 20;
tab_change();
}

function video_choice7(){
video_number = 7;
video_counter = 6;
tab_change();
}

function video_choice8(){
video_number = 8;
video_counter = 8;
tab_change();
}


// 60 fps 間隔で実行する
setInterval(function (){
//動画が最後までいったらカウントプラス
if(video.currentTime == video.duration && !watched_bool){
  // console.log("current"+video.currentTime);
  // console.log("duration"+video.duration);
  // console.log("watch"+watched_bool);
  //視聴回数カウント
  watched_count[folder_count-1]+=1;
  //1回みたら再生ボタンを押すか次へボタンを押すまでカウントしない
  watched_bool = true;

  //今日の日付データを変数hidukeに格納
  var hiduke=new Date();
  //年・月・日を取得する
  var year = hiduke.getFullYear();
  var month = hiduke.getMonth()+1;
  var day = hiduke.getDate();

  //php非同期通信(sqlの実行)
  $.ajax({
    type: "post",
    url: "new_count_post.php",
    data: {
      "ID_" : Student_num,
      "Year_": year,
      "Month_": month,
      "Day_": day,
      "Vid_": video_number,
      "Vid_num_": folder_count
    },
    success: function(data){
      console.log("ID:"+Student_num);
      console.log("year:"+year);
      console.log("month:"+month);
      console.log("day:"+day);
      console.log("Vid:"+video_number);
      console.log("vid_num:"+folder_count);
    },
    error: function(){
      alert("false");
    }
  });
}
// console.log("aaa"+watched_count[folder_count-1]);
},1000/60);




//再生時間の表示--------------------------
function init(){
video.addEventListener("timeupdate", function() {
  var now = Math.round(video.currentTime);
  var all = Math.round(video.duration);
  $('#now').html('現在の再生時間：' + now + 's');
  $('#all').html('合計時間：' + all + 's');
}, true);
};
$(function(){
init();
});




function play_video(){
video.play();
video2.play();
video3.play();
narration.play();
watched_bool = false;
video.volume = 0;
video2.volume = 0;
video3.volume = 0;
};

function pause_video(){
video.pause();
video2.pause();
video3.pause();
narration.pause();
};

function stop_video(){
//0病処理とかぶらないようにしている
video.currentTime = 0.0001;
video.pause();
video2.currentTime = 0;
video2.pause();
video3.currentTime = 0;
video3.pause();
narration.currentTime = 0;
//
zure_kansu();
narration.pause();
};




// ビデオのイベント--------------------------
video.addEventListener("timeupdate",function (e){
// スライダーを更新
element_slider.max = video.duration;
element_slider.value = video.currentTime;

},false);

//-------------------------
document.querySelector('video').onpause = function(){
  stop_bool = this.paused;
}

document.querySelector('video').onplay = function(){
  stop_bool = this.paused;
}


//動画移動
function next_video(){
video_plus();
// console.log("videos_img"+video_number+"/tyumoku" + folder_count+".png");
// 音声
narration_system();
watched_bool = false;
}

function back_video(){
video_minus();
narration_system();
watched_bool = false;
}



function reload(){
video_plus();
video_minus();
getCSV1();

getCSV3();
}

function　narration_system(){
var audio_ = "./narration"+video_number+"/"+folder_count+".MP3";
// console.log("ahfqofoq    "+audio_);
narration.src = audio_;
narration.play();
}


//十字キー--------------------------
document.onkeydown = function (e){
if(!e) e = window.event; // レガシー

// 出力テスト
var key_code = e.keyCode;

if(key_code == 37){
  video_minus();
  narration_system();
  watched_bool = false;
}
if(key_code == 39){
  video_plus();
  narration_system();
  watched_bool = false;
}
};

//動画変える時の処理
function video_change(){
if(video_number==1){
  video.src = "./videos"+video_number+"/No." +folder_count+ "/1.mov";
  //ファイルがあるかどうかの判定
  var filePath2 = "./videos"+video_number+"/No." +folder_count+ "/2.mov";
  var filePath3 = "./videos"+video_number+"/No." +folder_count+ "/3.mov";
  //ファイルがなければエラーを表示しないように
  // $.ajax(
  // 	{
  // 		url:filePath2,
  // 		type:'GET',
  // 		success: function(){
  // 			console.log("ある");
  // 			video2.src = "./videos"+video_number+"/No." +folder_count+ "/2.mov";
  // 		}
  // 	}
  // );
  video2.src = "./videos"+video_number+"/No." +folder_count+ "/2.mov";
  video3.src = "./videos"+video_number+"/No." +folder_count+ "/3.mov";
}else{
  video.src = "./videos"+video_number+"/No." +folder_count+ "/1.mp4";
  video2.src = "./videos"+video_number+"/No." +folder_count+ "/2.mp4";
  video3.src = "./videos"+video_number+"/No." +folder_count+ "/3.mp4";
  //ファイルがあるかどうかの判定
  // var filePath2 = "./videos"+video_number+"/No." +folder_count+ "/2.mp4";
  // var filePath3 = "./videos"+video_number+"/No." +folder_count+ "/3.mp4";
  // //ファイルがなければエラーを表示しないように
  // var xhr;
  // xhr = new XMLHttpRequest();
  // xhr.open("HEAD", filePath2, false);
  // xhr.send(null);
  // var status = xhr.status;
  // console.log(status);
  // if(status == "200"){
  // 	video2.src = "./videos"+video_number+"/No." +folder_count+ "/2.mp4";
  // 	console.log("あるよ");
  // }else{
  // 	console.log("ないよ");
  // }
  //
  // xhr.open("HEAD", filePath3, false);
  // xhr.send(null);
  // var status = xhr.status;
  // console.log(status);
  // if(status == "200"){
  // 	video3.src = "./videos"+video_number+"/No." +folder_count+ "/3.mp4";
  // 	console.log("あるよ");
  // }else{
  // 	console.log("ないよ");
  // }
}

}

//動画のナンバー
function video_plus(){
if(folder_count < video_counter){
  folder_count++;
  // console.log(folder_count);
}
else if(folder_count == video_counter){
  folder_count = 1;
  // console.log(folder_count);
}
video_change();
// element_slider.value = 0;
getCSV1();
getCSV3();
video.currentTime = 0;
video2.currentTime = 0;
video3.currentTime = 0;
narration.currentTime = 0;
zure_kansu();
// console.log("current"+video.currentTime);
// console.log(video2.currentTime);
// console.log(video3.currentTime);



img_change();


}


function img_change(){
// document.getElementById("tyumoku1").src = "videos_img"+video_number+"/tyumoku" + folder_count+".png";
// document.getElementById("tyumoku2").src = "videos_img"+video_number+"/tyumoku" + folder_count+"-2.png";

var filePath2 = "videos_img"+video_number+"/tyumoku" + folder_count+".png";
var xhr;
xhr = new XMLHttpRequest();
xhr.open("HEAD", filePath2, false);
xhr.send(null);
var status = xhr.status;
console.log(status);
if(status == "200"){
  document.getElementById("tyumoku1").src = "videos_img"+video_number+"/tyumoku" + folder_count+".png";
  document.getElementById("tyumoku1").height = 200;
  document.getElementById("tyumoku1").width = 355;
  console.log("あるよ");
}else{
  console.log("ないよ");
  document.getElementById("tyumoku1").height = 0;
  document.getElementById("tyumoku1").width = 0;
}

var filePath3 = "videos_img"+video_number+"/tyumoku" + folder_count+"-2.png";
xhr.open("HEAD", filePath3, false);
xhr.send(null);
var status = xhr.status;
console.log(status);
if(status == "200"){
  document.getElementById("tyumoku2").src = "videos_img"+video_number+"/tyumoku" + folder_count+"-2.png";
  document.getElementById("tyumoku2").height = 200;
  document.getElementById("tyumoku2").width = 355;
  console.log("あるよ");
}else{
  console.log("ないよ");
  document.getElementById("tyumoku2").height = 0;
  document.getElementById("tyumoku2").width = 0;
}
}




function video_minus(){
if(folder_count > 1){
  folder_count--;
  video_change();
  // element_slider.value = 0;
  getCSV1();
  getCSV3();
  video.currentTime = 0;
  video2.currentTime = 0;
  video3.currentTime = 0;
  zure_kansu();
  narration.currentTime = 0;
  img_change();
  // document.getElementById("tyumoku1").src = "videos_img"+video_number+"/tyumoku" + folder_count+".png";
  // document.getElementById("tyumoku2").src = "videos_img"+video_number+"/tyumoku" + folder_count+"-2.png";
}
}


//動画拡大部分
var element_big1 = document.getElementById("input_01_big");
var element_big2 = document.getElementById("input_02_big");
var element_big3 = document.getElementById("input_03_big");
setInterval(function (){
var video_width1=355;
var video_width2=495;

var video_height1=200;
var video_height2=350;

var b1;
b1 = element_big1.checked;
if(b1){
  video.width = video_width2;
  video.height = video_height2;
  // video.style = "margin-right:10px; margin-top:-10px";
  // video.style = "margin-right:10px; margin-top:-40px; margin-bottom:-21px;";
}else{
  video.width = video_width1;
  video.height = video_height1;
  // video.style = "margin:0px 0px 4px 0px;";
}

var b2;
b2 = element_big2.checked;
if(b2){
  video2.width = video_width2;
  video2.height = video_height2;
  // video2.style = "margin-right:10px; margin-top:-10px";
  // video2.style = "margin-right:10px; margin-top:-40px; margin-bottom:-20px;";
}else{
  video2.width = video_width1;
  video2.height = video_height1;
  // video2.style = "margin:0px 0px 4px 0px;";
}

var b3;
b3 = element_big3.checked;
if(b3){
  video3.width = video_width2;
  video3.height = video_height2;
  // video3.style = "margin-right:10px; margin-top:-10px";
  // video3.style = "margin-right:10px; margin-top:-40px; margin-bottom:-20px;";
}else{
  video3.width = video_width1;
  video3.height = video_height1;
  // video3.style = "margin:0px 0px 4px 0px;";
}


},1000/60);





// 各エレメントを取得--------------------------
var element_slider = document.getElementById("edit_02_slider");
var element_vol_slider = document.getElementById("volume_slider");

// イベントハンドラ
var event = "click" ;

(function (){
// スライダー変更時に実行されるイベント--------------------------
element_slider.onchange = function (){
  video.currentTime = this.value;
  video2.currentTime = this.value;
  video3.currentTime = this.value;
  //

  zure_kansu();


  narration.currentTime = this.value;
};
//ボリューム変更--------------------------
element_vol_slider.onchange = function (){
  video.volume = 0;
  video2.volume = 0;
  video3.volume = 0;

  narration.volume = this.value;
};

})();
function clickPosition( e )
{
// イベントオブジェクトの判定
var e = ( e || window.event.e ) ;

// 一般的なブラウザ
if( e.pageX || e.pageX )
{
  //それぞれの座標
  var x = e.pageX ;
  var y = e.pageY ;
}

// 古いブラウザ(Ie9以下)
else if( e.clientX || e.clientY )
{
  var dElm = document.documentElement , dBody = document.body ;
  var x = e.clientX + dBody.scrollLeft + dElm.scrollLeft ;
  var y = e.clientY + dBody.scrollTop + dElm.scrollTop ;
}

// それでもダメな場合
else
{
  return false ;
}
// アラート表示
// alert( "X座標:" + x + "\n" + "Y座標:" + y ) ;
var move = x/800;
video.currentTime = video.duration * move;
video2.currentTime = video.duration * move;
}



//csv------------------------------------------
//コメント1
function getCSV1(){
  var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
  var csv1 = "./videos"+video_number+"/text.csv";
  req.open("get", csv1, true); // アクセスするファイルを指定
  req.send(null); // HTTPリクエストの発行
  // レスポンスが返ってきたらconvertCSVtoArray()を呼ぶ
  req.onload = function(){
    convertCSVtoArray1(req.responseText); // 渡されるのは読み込んだCSVデータ
  }
}

// 読み込んだCSVデータを二次元配列に変換する関数convertCSVtoArray()の定義
function convertCSVtoArray1(str){ // 読み込んだCSVデータが文字列として渡される
var tmp = str.split(",");//1次元配列なのでこれでOK、tmpに結果が入る
//ビデオがいくつあるかはタイトルに起因
//タイトル変更
document.getElementById('csv1').innerHTML = tmp[folder_count-1];
}
getCSV1();


//動画タイトル
function getCSV3(){
  var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
  var csv1 = "./videos"+video_number+"/title.csv";
  req.open("get", csv1, true); // アクセスするファイルを指定
  req.send(null); // HTTPリクエストの発行

  // レスポンスが返ってきたらconvertCSVtoArray()を呼ぶ
  req.onload = function(){
    convertCSVtoArray3(req.responseText); // 渡されるのは読み込んだCSVデータ
  }
}
// タイトルCSV読み込み(一時限配列)
function convertCSVtoArray3(str){ // 読み込んだCSVデータが文字列として渡される
var tmp = str.split(",");//1次元配列なのでこれでOK、tmpに結果が入る
//ビデオがいくつあるかはタイトルに起因
//タイトル変更
if(video_number == 4){
  //4番目の動画だけ注意書きを入れる
  document.getElementById('title').innerHTML = tmp[folder_count-1]+"(手洗い後は手袋を着用しますが、手元をわかりやすくするために外しています。)";
}else{
  document.getElementById('title').innerHTML = tmp[folder_count-1];
}

}
getCSV3(); //最初に実行される


//動画のズレ秒数
function getCSV4(){
  var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
  var csv1 = "./videos"+video_number+"/zure.csv";
  req.open("get", csv1, true); // アクセスするファイルを指定
  req.send(null); // HTTPリクエストの発行

  // レスポンスが返ってきたらconvertCSVtoArray()を呼ぶ
  req.onloadend = function(){
    convertCSVtoArray4(req.responseText); // 渡されるのは読み込んだCSVデータ
  }
}
// タイトルCSV読み込み(一時限配列)
function convertCSVtoArray4(str){ // 読み込んだCSVデータが文字列として渡される
// var result = []; // 最終的な二次元配列を入れるための配列
var tmp = str.split("\r"); // 改行を区切り文字として行を要素とした配列を生成
//mac の場合改行コードは\n, win \n

// 各行ごとにカンマで区切った文字列を要素とした二次元配列を生成
for(var i=0;i<tmp.length;++i){
    zure[i] = tmp[i].split(',');
    // console.log(zure[i]);
}

video.currentTime += zure[folder_count-1][1];
video2.currentTime += zure[folder_count-1][2];
video3.currentTime += zure[folder_count-1][3];
// console.log("videocount"+zure[folder_count-1][0]);
// console.log(zure[folder_count-1][1]);
// console.log(zure[folder_count-1][2]);
// console.log(zure[folder_count-1][3]);
read_1 = false;
}
getCSV4(); //最初に実行される

function zure_kansu(){
if(!read_1){
  video.currentTime += zure[folder_count-1][1];
  video2.currentTime += zure[folder_count-1][2];
  video3.currentTime += zure[folder_count-1][3];
}
}




//----------------------------------------------------


</script>





</html>
