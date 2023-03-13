<?php
	session_start();
	if(isset($_SESSION['name'])){
		$_Student_num=$_SESSION['name'];
	}else{
		echo "ログインしてください";
	}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Document_</title>

    <script src="./../js/jquery.min.js"></script>
  	<script src="./../js/jquery_ui.min.js"></script>
    <!-- css読み込み -->
  	<link href="./../css/bootstrap.min.css" rel="stylesheet" media="screen">
  	<!-- <link href="css/video_container.css" rel="stylesheet"> -->
  	<script type="text/javascript" src="./../js/footerFixed.js"></script>

    <style type="text/css">
    div#footer{
			border:1px dotted black;
			background-color:#e0ffff;
		}
		.video_box div{
			display: inline-block;

		}
		canvas{
			width: 65vw;
		}
		.buttons{
			display: inline-block;
			/*border: 1px solid #FF9900;*/
		}
		[type="range"] {
	    -webkit-appearance:none;

			cursor:pointer;
			width:100%;
			vertical-align:middle;

			background-color:rgba(255, 255, 255, 1.0);

			-webkit-box-shadow:0px 1px 3px rgba(0, 0, 0, 0.2) inset;
			-moz-box-shadow:0px 1px 3px rgba(0, 0, 0, 0.2) inset;
			box-shadow:0px 1px 3px rgba(0, 0, 0, 0.2) inset;

			-webkit-border-radius:24px;
			-moz-border-radius:24px;
			border-radius:24px;

		}
		[type="range"]::-webkit-slider-thumb {
	    -webkit-appearance:none;
			cursor:pointer;

	    position:relative;
	    z-index:5;

	    border:none;
	    width:4rem;
	    height:4rem;

	    background-color:rgba(255, 160, 225, 1.0);

	    -webkit-border-radius:50%;
		  -moz-border-radius:50%;
	    border-radius:50%;
		}
    </style>

</head>
  <body>

    <!-- Static navbar -------------------------------------------->
  	<nav class="navbar navbar-default">
  		<div class="container-fluid">
  			<div class="navbar-header">
  				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
  					<span class="sr-only">Toggle navigation</span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
  				<a class="navbar-brand" href="#1">Sunflower</a>
  			</div>
  			<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
  				<ul class="nav navbar-nav" style="top-margin:5px">
  					<div class="btn-group">
  						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  							基礎看護援助技術Ⅰ
  							<span class="caret"></span>
  						</button>
  						<ul class="dropdown-menu" role="menu">
  							<li><a href="#1" onclick="video_choice1()">ボディメカニクスを活用したベッドメーキング</a></li>
  							<li><a href="#2" onclick="video_choice2()">臥症患者のベッドメーキング</a></li>
  						</ul>
  					</div>

  					<div class="btn-group">
  						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  							基礎看護援助技術Ⅱ(滅菌操作編)
  							<span class="caret"></span>
  						</button>
  						<ul class="dropdown-menu" role="menu">
  							<li><a href="#5" onclick="video_choice8()">滅菌手袋の着脱編</a></li>
  							<li><a href="#5" onclick="video_choice7()">滅菌状態の確認と取り扱い編</a></li>
  							<li><a href="#5" onclick="video_choice6()">無菌操作・消毒綿球の作り方編</a></li>
  						</ul>
  					</div>

  					<div class="btn-group">
  						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  							基礎看護援助技術Ⅱ(注射技術編)
  							<span class="caret"></span>
  						</button>
  						<ul class="dropdown-menu" role="menu">
  							<li><a href="#3" onclick="video_choice3()">6R編</a></li>
  							<li><a href="#4" onclick="video_choice4()">注射準備編</a></li>
  							<li><a href="#5" onclick="video_choice5()">筋肉・皮下注射</a></li>
  						</ul>
  					</div>
  				</ul>
  				<p class="navbar-text navbar-right" id="st_num">
  					<?php
  						if(empty($_Student_num)){
  							// echo "ログインしてください";
  						}else{
  							echo "ようこそ".$_Student_num."さん";
  						}
  					?>
  				</p>
  			</nav>
  		</div>
  	</nav>
  	<!-- navbar ------------------------------------------->

		<!-- タイトル -->
		<p id="title" style="background-color:#ffcc99" >CSVエラー</p>

		<div id="video-area" style="display:none;"></div>

		<div class="video_box">
			<!-- <div id="canvas-area"></div> -->

			<canvas id="canvas_1"></canvas>
			<canvas id="canvas_2"></canvas>
			<canvas id="canvas_3"></canvas>

			<div id="slider_box">
				<div id="resInsertBefore"></div>
				<!-- <input type="image" id="samune" src="./../img/seek_not.png" style="width:800px; height:29px;" margin="-30px"> -->
				<input type="range" id="edit_02_slider" style="width:90vw; margin: 0px 0px 0px 4vw;" min="0" max="1.0" step="0.00001" value="0.0"></input>

				<!-- テキスト -->
				<p id="text" style="background-color:#ffcc99" >CSVエラー</p>
			</div>

			<div>
				<input type="image" ontouchend="play_video()" src="./../img/start_button.png" style="width:10vw; height:6vh; margin:0px 5vw 5px 5vw;" title="再生">
				<input type="image" ontouchend="pause_video()" src="./../img/stop_button.png" style="width:10vw; height:6vh; margin:0px 5vw 5px 0px;" title="一時停止">
				<!-- <input type="image" ontouchend="stop_video()" src="./../img/stop_button2.png" style="width:10vw; height:6vh; margin:0px 5px 5px 0px;" title="停止"> -->
				<!-- <img src="./../img/volumu_button.png" style="width:10vw; height:6vh; margin:0px 5px 10px 0px;">
				<input type="range" id="volume_slider" style="width:30vw; padding:0px 0px 10px 0px; display:inline" min="0" max="1.0" step="0.00001" value="1.0"></input> -->
				<input type="image" ontouchend="video_minus()" src="./../img/back_button.png" style="width:25vw; height:6vh; margin:0px 5vw 5px 0px;" title="前動画">
				<input type="image" ontouchend="video_plus()" src="./../img/next_button.png" style="width:25vw; height:6vh; margin:0px 5px 5px 0px;" title="次動画">
			</div>
			<div>
				<!-- <input type="image" ontouchend="back_video()" src="./../img/back_button.png" style="width:25vw; height:6vh; margin:0px 5px 5px 0px;" title="前動画">
				<input type="image" ontouchend="next_video()" src="./../img/next_button.png" style="width:25vw; height:6vh; margin:0px 5px 5px 0px;" title="次動画"> -->
				<!-- <input type="image" ontouchend="reload()" src="./../img/zure.png" style="width:25vw; height:height:6vh; margin:0px 5px 5px 5vw;" title="次動画"> -->
			</div>
		</div>

		<div style="display:none">
			<audio id = "audio" preload ="auto"/>
				<!-- <source src="./narration1/1.mp3"> -->
			</audio>
		</div>




    <!-- <button id="btn">PLAY</button> -->
		<script type="text/javascript">var Student_num  = "<?= $_Student_num ?>";</script>
    <script src="./../js/video_smartphone.js"></script>



      <style>
          /** {
              margin: 0;
              padding: 0;
          }
          .video {
              display: none;
              width: 100%;
          }
          canvas {
              width: 320px;
              height: 180px;
              border: 1px solid #ccc;
          }*/
      </style>



      <!-- フッター -->
    	<div id="footer">
    		Copyright © 2016-2017 Shubun University          create by Aichi Institute of Technology Sawano-lab
    	</div>


    	<!-- プラグイン -------------------------------------------->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script>window.jQuery || document.write('<script src="bootstrap/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    	<script src="./../bootstrap/docs/dist/js/bootstrap.min.js"></script>
    	<script>
    		$(document).ready(function () {
    			$(".navbar-nav li a").click(function(event) {
    				$(".navbar-collapse").collapse('hide');
    			});
    		});
    	</script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    	<script src="./../bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- プラグイン -------------------------------------------->
  </body>
</html>
