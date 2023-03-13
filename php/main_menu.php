<?php
	session_start();
	if(isset($_SESSION['name'])){
		$_Student_num=$_SESSION['name'];
	}else{
		echo "ログインしてください";
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<script src="./../js/jquery.min.js"></script>
	<script src="./../js/jquery_ui.min.js"></script>
	<script src="./../js/jquery.scrolltable.js"></script>
  <!-- タイトル -->
  <title>MainPage</title>

  <!-- css読み込み -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

  <!-- css -->
  <style>
    body{
      padding-top: 80px;
    }
    /*.rec{
			display: none;
		}*/
    .playback{
			display: none;
		}
		/*.playback_others{
			display: none;
		}*/
		.admin{
			display: none;
		}
		.admin_nav{
			display: none;
		}
  </style>




  <!-- ログインに使用する部分 -->
  <!-- <script type="text/javascript" src="login.js"></script> -->
  <!--                     -->
</head>


<body>
  <nav class="navbar navbar-default navbar-fixed-top">
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
          <li><a href="#0" onclick="video_push()">教師ビデオ閲覧</a></li>
					<li><a href="#1" onclick="playback_push()">撮影した映像閲覧</a></li>
          <!-- <li><a href="#1" onclick="rec_push()">演習撮影</a></li> -->
          <li><a href="#2" onclick="pdf1_push()">視聴ツール説明書</a></li>
					<li><a href="#3" onclick="pdf2_push()">録画ツール説明書</a></li>
					<!-- <li><a href="#3" onclick="playback_others_push()">他人の映像閲覧</a></li> -->
					<li><a href="#4" onclick="admin_push()" class="admin_nav" style="display:none;">管理者画面</a></li>
				</ul>
				<div class="btn-group navbar-right" id="st_num">
					<button type="button" class="btn btn-default dropdown-toggle navbar-right" data-toggle="dropdown" aria-expanded="false">
						<?php
							if(empty($_Student_num)){
								// echo "ログインしてください";
							}else{
								echo "ようこそ".$_Student_num."さん";
							}
						?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="./../html/change_password.html">パスワードの変更</a></li> -->
						<li role="presentation"><a role="menuitem" tabindex="-1" href="./logout.php">ログアウト</a></li>
					</ul>
				</div>

			</nav>
		</div>
	</nav>
	<!-- navbar ------------------------------------------->


  <div class="container" font-size="50px">
    <div class="main">
      <h1>
        <?php
          if(empty($_Student_num)){
            // echo "ログインしてください";
          }else{
            echo "ようこそ".$_Student_num."さん!";
          }
        ?><br>
      </h1>
      <h3>
        画面上部から演習ビデオの閲覧と演習撮影が選択できます。
      </h3>
    </div>


    <!-- <div class="rec"></div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="./../js/rec.js"></script> -->

    <div class="playback"></div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="./../js/playback.js"></script>

		<!-- <div class="playback_others"></div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="./../js/playback_others.js"></script> -->

		<div class="admin"></div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="./../js/admin.js"></script>
  </div>




  <!-- <form name="form1" id="id_form1" action="">
    学籍番号　：<input name="textBox1" id="id_textBox1" type="text" value="" />
    <br>
    パスワード：<input name="textBox2" id="id_textBox2" type="password" value="" />
    <br>
    <input type="submit" value="Exec" onclick="onButtonClick();" />
  </form> -->
  <div id="output"></div>
  <!-- </form> -->





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



<!-- 上部のログイン押した時 -->
<script type="text/javascript">
var user_name = <?php echo json_encode($_Student_num, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	if(user_name == "admin"){
		$('.admin_nav').css('display','block');
		// console.log("admin login");
	}else{
		$('.admin_nav').hide();
	}


  function video_push(){
    $(function(){
      window.open('video1.php');
      // $('.rec').hide();
      $('.main').show();
      $('.playback').hide();
			// $('.playback_others').hide();
			$('.admin').hide();
    });
  }
	function pdf1_push(){
    $(function(){
      window.open('./../pdf/tool_intro.pdf');
      // $('.rec').hide();
      $('.main').show();
      $('.playback').hide();
			// $('.playback_others').hide();
			$('.admin').hide();
    });
  }
	function pdf2_push(){
    $(function(){
      window.open('./../pdf/manual.pdf');
      // $('.rec').hide();
      $('.main').show();
      $('.playback').hide();
			// $('.playback_others').hide();
			$('.admin').hide();
    });
  }
  function rec_push(){
    $(function(){
      // $('.rec').show();
      $('.main').hide();
      $('.playback').hide();
			// $('.playback_others').hide();
			$('.admin').hide();
    });
  }
  function playback_push(){
    $(function(){
      // $('.rec').hide();
      $('.main').hide();
      $('.playback').show();
			// $('.playback_others').hide();
			$('.admin').hide();
    });
  }
	function playback_others_push(){
    $(function(){
      // $('.rec').hide();
      $('.main').hide();
      $('.playback').hide();
			// $('.playback_others').show();
			$('.admin').hide();
    });
  }
	function admin_push(){
    $(function(){
      // $('.rec').hide();
      $('.main').hide();
      $('.playback').hide();
			// $('.playback_others').hide();
			$('.admin').show();
    });
  }


</script>


</html>
