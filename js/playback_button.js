//videoのボタンが押されたとき
var video = document.getElementById("video");
var video_type;
function getId(id_value){
  //ボタンでsrc変更
  video.src = "./../upload/movies/"+User+"/" +id_value;
  // ビデオのタイトルごとに分類分け
  video_type = id_value.split("_");
  //video_type[0]に入る
  // console.log(video_type[0]);
}
