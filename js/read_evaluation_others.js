//評価テキスト
function getCSV2(){
  var video_number = 1;
  var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
  var csv1 = "./../videos/videos"+video_number+"/test.csv";
  req.open("get", csv1, true); // アクセスするファイルを指定
  req.send(null); // HTTPリクエストの発行
  // console.log("awqdwq");
  // レスポンスが返ってきたらconvertCSVtoArray()を呼ぶ
  req.onload = function(){
    convertCSVtoArray2(req.responseText); // 渡されるのは読み込んだCSVデータ
  }
}

// 配列長さ用変数
var tmp_len2;
// CSV読み込み(一時限配列)
function convertCSVtoArray2(str){ // 読み込んだCSVデータが文字列として渡される
  var tmp = str.split(",");//1次元配列なのでこれでOK、tmpに結果が入る
  //ビデオがいくつあるかはタイトルに起因
  // console.log("fnqwifnqwonfqwoifnqwoifnqwoinfwqoifndpwifnqwfnqpwi");
  // 配列長さ取得
  tmp_len2 = tmp.length;
  //ラジオボタン送信フォーム
  // var files = '<form name="Myform" action="./../php/send_SQL_playback.php" method="POST">';
  var files = '<table border="1" cellpadding="10" width="100%"><th style="text-align: center;">評価項目<\/th><th style="text-align: center;">評価<\/th>';
  for(i=0;i<tmp_len2;i++){
  //var sosu = sosu +'<label><input type=radio name=mus onClick="func1(this)" onkeypress="func1(this)" value="'+ file[i] +'">'+ file[i] +'</label><br>';
  //html要素の属性はダブルコーテーションでくくる、終了タグのスラッシュはエスケープしておく
  // onClick="count_radio()"により，イベント発火
  files = files + '<tr align="center"><td>'+tmp[i]+'<\/td><td><p>o<input type="radio" name="q'+i+'" id="q'+i+'" value="2" required>  △<input type="radio" name="q'+i+'" id="q'+i+'" value="1" required>  x<input type="radio" name="q'+i+'" id="q'+i+'" value="0" required><\/p><\/td><\/tr>';
  }
  //forで使う変数(なんこ評価項目があるか)と，送信ボタン
  files = files + '<input type="text" name="type_num" style="display:none" value="'+tmp_len2+'"><\/table>';
  // files = files + '<input type="text" name="type_num" style="display:none" value="'+tmp_len+'"><button class="btn btn-default" type="submit" name="Submit" id="Submit" value="送信">評価を完了する</form>';
  // console.log(files);

  document.getElementById('hyouji2').innerHTML = files;
}
getCSV2(); //最初に実行される
