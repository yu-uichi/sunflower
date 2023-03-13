//videoのボタンが押されたとき
var video2 = document.getElementById("video2");
var video_type2;
function getId2(id_value){
  //ボタンでsrc変更
  video2.src = "./../upload/movies/"+User+"/" +id_value;
  console.log("./../upload/movies/"+User+"/" +id_value);
  // ビデオのタイトルごとに分類分け
  video_type = id_value.split("_");
  //video_type[0]に入る
  console.log(video_type[0]);
}
