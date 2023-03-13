
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <!-- <script src="js/jquery.min.js"></script> -->
	<script src="./js/jquery.min.js"></script>
	<script src="./js/jquery_ui.min.js"></script>
	<script src="./js/jquery.scrolltable.js"></script>
  <!-- タイトル -->
  <title>MainPage</title>

  <!-- css読み込み -->
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

  <!-- css -->
  <style>
    body{
      padding-top: 80px;
    }
    .register{
			display: none;
		}
  </style>




  <!-- ログインに使用する部分 -->
  <!-- <script type="text/javascript" src="login.js"></script> -->
  <!--                     -->
</head>


<body>
  <!-- Static navbar -------------------------------------------->
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
          <div class="btn-group">
						<li><a href="#0" onclick="Login_push()">ログイン</a></li>
					</div>
        </ul>
        <ul class="nav navbar-nav" style="top-margin:5px">
          <div class="btn-group">
						<li><a href="#1" onclick="Register_push()">ユーザ登録</a></li>
					</div>
        </ul>
      </nav>
		</div>
	</nav>
	<!-- navbar ------------------------------------------->

  <div class="container">
    <div class="login">
      <form name="form1" id="id_form1" action="./php/login2.php" method="post">
        <fieldset>
          <legend><h1>ログイン</h1></legend>
          <div class="form-group">
            <label>学籍番号</label>
            <input type="text" name="student_number" class="form-control" placeholder="1670000" id="id_textBox1">
            <p class="help-block">学籍番号は7桁で入力してください</p>
          </div>

          <div>
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" id="id_textBox2">
            <p class="help-block">学籍番号とパスワードを入力したら，下のExecボタンを押してください</p>
          </div>

          <!-- <button type="submit" value="Exec" class="btn btn-default" onclick="onButtonClick();">Exec</button> -->
          <button type="submit" value="Exec" class="btn btn-default">Exec</button>
        </fieldset>
      </form>
      <div id="output"></div>
    </div>
    <!--  -->

  </div>




  <div class="register"></div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="./js/register.js"></script>



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



<!-- 上部のログイン押した時 -->
<script type="text/javascript">
  function Login_push(){
    $(function(){
      $('.login').show();
      $('.register').hide();
    });
  }
  function Register_push(){
    $(function(){
      $('.login').hide();
      $('.register').show();
    });
  }
  function pdf1_push(){
    $(function(){
      window.open('./pdf/tool_intro.pdf');
      $('.login').show();
      $('.register').hide();
    });
  }
  function pdf2_push(){
    $(function(){
      window.open('./pdf/manual.pdf');
      $('.login').show();
      $('.register').hide();
    });
  }


</script>


</html>
