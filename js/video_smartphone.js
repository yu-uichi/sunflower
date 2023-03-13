// videoの埋め込み
var video1 = document.createElement('video');
var video2 = document.createElement('video');
var video3 = document.createElement('video');
document.getElementById('video-area').appendChild(video1);
document.getElementById('video-area').appendChild(video2);
document.getElementById('video-area').appendChild(video3);
// 動画の表示サイズ
// var videoWidth = 320;
// var videoHeight = 180;
var videoWidth = window.parent.screen.width * 0.8;
var videoHeight = videoWidth * 0.6;
 // 動画のビットレート
var bitrate = 29.97;


var btn;
btn = document.getElementById('btn');
// audio要素
var audio = document.getElementById("audio");
var audio_path = "./../narration/narration1/5.MP3"
// audio = new Audio(audio_path);
audio.src = audio_path;
// audio.load();
// audio.play();

//動画の一時停止
var stop = true;

//学籍番号
// var Student_num = "<?php echo $_Student_num ?>";
console.log(Student_num);

// canvasの埋め込み
var canvas1 = document.getElementById('canvas_1');
var canvas2 = document.getElementById('canvas_2');
var canvas3 = document.getElementById('canvas_3');



// 動画の経過時間
var elapsedTime1;
var elapsedTime2;
var elapsedTime3;

// 動画のインターバルを解除するための変数
var video_interval1;
var video_interval2;
var video_interval3;

//動画のズレ調整
var zure=[];

// 動画が完全に再生可能となったら再生開始
video1.addEventListener('canplaythrough', function() {
    // canvasの準備
    if(!canvas1 || !canvas1.getContext) return false;
    var ctx = canvas1.getContext('2d');

    //ここを変えれば初期秒数が変更可能
    // 動画の経過時間
    //ズレを調整(キャストしないとダメっぽい)
    elapsedTime1 = parseFloat(zure[folder_count-1][1]);
    // console.log(zure[folder_count-1][1]);
    // 前回のgetTime()
    var lastTime = new Date().getTime();
    video_interval1 = setInterval(function() {
      // 現在のgetTime()
      var currentTime = new Date().getTime();
      // 前回と現在のgetTime()の差
      var df = currentTime - lastTime;

      //ストップボタンが押されていなければ
      if(!stop){
        elapsedTime1 += df / 1000; // ミリ秒単位を秒単位にして、経過時間に追加
      }


      // videoに経過時間を反映
      video1.currentTime = elapsedTime1;
      // 前回のgetTime()を更新
      lastTime = currentTime;

      // console.log(video1.currentTime);
      // 経過時間が動画の長さ以上になった時、経過時間を0に戻す
      // if(elapsedTime >= video1.duration) {
      //     elapsedTime = 0;
      // }
      // canvasの描画
      ctx.drawImage(video1, 0, 0, videoWidth, videoHeight);
    }, 1000 / bitrate);
});

// 動画が完全に再生可能となったら再生開始
video2.addEventListener('canplaythrough', function() {
    // canvasの準備
    if(!canvas2 || !canvas2.getContext) return false;
    var ctx = canvas2.getContext('2d');

    //ズレを調整(キャストしないとダメっぽい)
    elapsedTime2 = parseFloat(zure[folder_count-1][2]);
    var lastTime = new Date().getTime(); // 前回のgetTime()
    video_interval2 = setInterval(function() {
        var currentTime = new Date().getTime(); // 現在のgetTime()
        var df = currentTime - lastTime; // 前回と現在のgetTime()の差

        //ストップボタンが押されていなければ
        if(!stop){
          elapsedTime2 += df / 1000; // ミリ秒単位を秒単位にして、経過時間に追加
        }
        video2.currentTime = elapsedTime2; // videoに経過時間を反映
        lastTime = currentTime; // 前回のgetTime()を更新
        // 経過時間が動画の長さ以上になった時、経過時間を0に戻す
        // if(elapsedTime >= video2.duration) {
        //     elapsedTime = 0;
        // }



        // canvasの描画
        ctx.drawImage(video2, 0, 0, videoWidth, videoHeight);
    }, 1000 / bitrate);
});

// 動画が完全に再生可能となったら再生開始
video3.addEventListener('canplaythrough', function() {
    // canvasの準備
    if(!canvas3 || !canvas3.getContext) return false;
    var ctx = canvas3.getContext('2d');

    //ズレを調整(キャストしないとダメっぽい)
    elapsedTime3 = parseFloat(zure[folder_count-1][3]);
    var lastTime = new Date().getTime(); // 前回のgetTime()
    video_interval3 = setInterval(function() {
        var currentTime = new Date().getTime(); // 現在のgetTime()
        var df = currentTime - lastTime; // 前回と現在のgetTime()の差

        //ストップボタンが押されていなければ
        if(!stop){
          elapsedTime3 += df / 1000; // ミリ秒単位を秒単位にして、経過時間に追加
        }

        video3.currentTime = elapsedTime3; // videoに経過時間を反映
        lastTime = currentTime; // 前回のgetTime()を更新
        // 経過時間が動画の長さ以上になった時、経過時間を0に戻す
        // if(elapsedTime >= video3.duration) {
        //     elapsedTime = 0;
        // }
        // canvasの描画
        ctx.drawImage(video3, 0, 0, videoWidth, videoHeight);
    }, 1000 / bitrate);
});

// 初回かどうか判断
var init = 0;

//ボタン
function play_video(){
  stop = false;
  audio.play();
  //スマホでは自動再生ができないので、初回だけスタートボタンを押すことで起動する
  if(init == 0){
    narration_system();
    init++;
  }
}
function pause_video(){
  stop = true;
  audio.pause;
  audio.pause();
}

// function reload(){
// 	video_plus();
// 	video_minus();
// 	getCSV1();
// 	getCSV3();
// }



//bar--------------------------
var element_slider = document.getElementById("edit_02_slider");

(function (){
	// スライダー変更時に実行されるイベント--------------------------
	element_slider.onchange = function (){
		elapsedTime1 = video1.duration * this.value;
    elapsedTime2 = video2.duration * this.value;
    elapsedTime3 = video3.duration * this.value;
		// video2.currentTime = this.value;
    // video3.currentTime = this.value;

    console.log(video1.duration);
    console.log(video1.duration * this.value);
    console.log(this.value);
		// zure_kansu();


		audio.currentTime = audio.duration * this.value;
	};

})();




// 動画を変更する部分-------------------------------------------
// 最初の動画読み込み
video1.src = './../videos/videos1/No.1/1.mp4';
video1.load();
// video2.src = './../videos/videos1/No.5/2.mp4';
// video2.load();
// video3.src = './../videos/videos1/No.5/3.mp4';
// video3.load();

//ビデオがいくつあるかの変数
var video_counter;
//現在のフォルダ
var folder_count;
// 演習種類
var video_number;
//初期設定
video_counter = 23;
folder_count = 1;
video_number = 1;






//動画変える時の処理
function video_change(){
  //intervalを解除しないとどんどん倍速になる
  clearInterval(video_interval1);
  clearInterval(video_interval2);
  clearInterval(video_interval3);

	video1.src = "./../videos/videos"+video_number+"/No." +folder_count+ "/1.mp4";
  video1.load();
	// video_phone1.src = "./../videos/videos"+video_number+"/No." +folder_count+ "/1.mp4";
	// video2.src = "./../videos/videos"+video_number+"/No." +folder_count+ "/2.mp4";
	// video3.src = "./../videos/videos"+video_number+"/No." +folder_count+ "/3.mp4";

	var filePath = "./../videos/videos"+video_number+"/No." +folder_count+ "/2.mp4";
	var xhr;
	xhr = new XMLHttpRequest();
	xhr.open("HEAD", filePath, false);
	xhr.send(null);
	var status = xhr.status;
	console.log(status);
	if(status == "200"){
		video2.src = "./../videos/videos"+video_number+"/No." +folder_count+ "/2.mp4";
    video2.load();
		video2.height = videoHeight;
		video2.width = videoWidth;
		console.log("あるよ");
	}else{
    //canvasの解除
    var ctx = canvas2.getContext('2d');
    // canvasの描画
    ctx.clearRect(0, 0, videoWidth, videoHeight);
		console.log("ないよ");
		video2.height = 0;
		video2.width = 0;
	}

	var filePath2 = "./../videos/videos"+video_number+"/No." +folder_count+ "/3.mp4";
	var xhr;
	xhr = new XMLHttpRequest();
	xhr.open("HEAD", filePath2, false);
	xhr.send(null);
	var status = xhr.status;
	console.log(status);
	if(status == "200"){
		video3.src = "./../videos/videos"+video_number+"/No." +folder_count+ "/3.mp4";
		video3.load();
		video3.height = videoHeight;
		video3.width = videoWidth;
		console.log("あるよ");
	}else{
    //canvasの解除
    var ctx = canvas3.getContext('2d');
    // canvasの描画
    ctx.clearRect(0, 0, videoWidth, videoHeight);
		console.log("ないよ");
		video3.height = 0;
		video3.width = 0;
	}
}

//動画のナンバー
function video_plus(){
	if(folder_count < video_counter){
		folder_count++;
		console.log("folcnt"+folder_count);
	}
	else if(folder_count == video_counter){
		folder_count = 1;
		console.log("folcnt"+folder_count);
	}
	tab_change();
}
function video_minus(){
	if(folder_count > 1){
		folder_count--;
		tab_change();
	}
}




// BGM処理-------------------------------------------
function　narration_system(){
  var audio_path = "./../narration/narration"+video_number+"/"+folder_count+".MP3";
  // audio = new Audio(audio_path);
  audio.src = audio_path;
  audio.load();
  audio.play();
}


//BGMとビデオ変更の総括
function tab_change(){
  send_playback_information();
  video_change();
  narration_system();
  stop = false;
  console.log("change");

  getCSV1();
  getCSV3();
  // getCSV4();
}


//CSV読み込み
//csv------------------------------------------
//コメント1
function getCSV1(){
    var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
    var csv1 = "./../videos/videos"+video_number+"/text.csv";
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
	document.getElementById('text').innerHTML = tmp[folder_count-1];
}
getCSV1();
//
//
// //動画タイトル
function getCSV3(){
    var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
    var csv1 = "./../videos/videos"+video_number+"/title.csv";
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
//
//
// //動画のズレ秒数
function getCSV4(){
    var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
    var csv1 = "./../videos/videos"+video_number+"/zure.csv";
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
			console.log(zure[i]);
	}
}
getCSV4(); //最初に実行される


//どの動画を見たかの送信
function send_playback_information(){
  //php非同期通信(sqlの実行)
  $.ajax({
    type: "post",
    url: "watch_teacher_videos.php",
    data: {
      "ID_" : Student_num,
      "ExercisesType_": video_number,
      "Vid_num_": folder_count
    },
    success: function(data){
      console.log("ID:"+Student_num);
      console.log("Vid:"+video_number);
      console.log("vid_num:"+folder_count);
    },
    error: function(){
      alert("false");
    }
  });
}
//一回目見てくれたときはとりあえず動画1をカウント
send_playback_information();





//演習種類----------------------------------------------------------------------
function video_choice1(){
	video_number = 1;
	video_counter = 23;
	tab_change();
  getCSV4();
}
function video_choice2(){
	video_number = 2;
	video_counter = 45;
	tab_change();
  getCSV4();
}
function video_choice3(){
	video_number = 3;
	video_counter = 6;
	tab_change();
  getCSV4();
}
function video_choice4(){
	video_number = 4;
	video_counter = 20;
	tab_change();
  getCSV4();
}
function video_choice5(){
	video_number = 5;
	video_counter = 23;
	tab_change();
  getCSV4();
}
function video_choice6(){
	video_number = 6;
	video_counter = 20;
	tab_change();
  getCSV4();
}
function video_choice7(){
	video_number = 7;
	video_counter = 6;
	tab_change();
  getCSV4();
}
function video_choice8(){
	video_number = 8;
	video_counter = 8;
	tab_change();
  getCSV4();
}
