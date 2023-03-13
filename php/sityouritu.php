<!DOCTYPE html>
<html>
<head>
<title>video1テーブル表示</title>
<meta charset="utf-8">
</head>
<body>
<h1>視聴回数表示ページ</h1>

<script type="text/javascript">
// //動画のズレ秒数
function getCSV4(){
    var req = new XMLHttpRequest(); // HTTPでファイルを読み込むためのXMLHttpRrequestオブジェクトを生成
    var csv1 = "./../js/sityouritu.csv";
    req.open("get", csv1, true); // アクセスするファイルを指定
    req.send(null); // HTTPリクエストの発行

    // レスポンスが返ってきたらconvertCSVtoArray()を呼ぶ
    req.onloadend = function(){
      convertCSVtoArray4(req.responseText); // 渡されるのは読み込んだCSVデータ
    }
}
var unko = [];

// タイトルCSV読み込み(一時限配列)
function convertCSVtoArray4(str){ // 読み込んだCSVデータが文字列として渡される
	// var result = []; // 最終的な二次元配列を入れるための配列
	var tmp = str.split("\r"); // 改行を区切り文字として行を要素とした配列を生成
	//mac の場合改行コードは\n, win \n

	// 各行ごとにカンマで区切った文字列を要素とした二次元配列を生成
	for(var i=1;i<tmp.length;++i){
			unko[i] = tmp[i].split(',');
			unko[i+1] = tmp[i+1].split(',');
			// console.log(unko[i][0]);
			// console.log(unko[i+1][0]);

			if(unko[i][0] != unko[i+1][0]){
				console.log(unko[i][1]);
				document.write(unko[i]);
				document.write("<br>");
			}


	}
}
getCSV4(); //最初に実行される

</script>



</body>
</html>
