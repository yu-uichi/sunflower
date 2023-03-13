


function a(){
  //ユーザ名取得
  var User = <?php echo json_encode($user, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
  // 動画取得
  var array = <?php echo json_encode($movies, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
  // var files = '<h3>動画を閲覧したい学生の学籍番号を打ち込んでください</h3><br>';
  var files = '';
  //日付
  var y='', m='', d='';
  //動画の種類
  var movie_type = '';
  // Object.keys(array).length ->配列の長さ
  for(i=0;i<Object.keys(array).length;i++){
    var movie_slice = array[i].split("_");
    // console.log(movie_slice[0]);
    // console.log(movie_slice[1]);

    y = movie_slice[1].slice(0,4);
    m = movie_slice[1].slice(4,6);
    d = movie_slice[1].slice(6,8);
    //動画の種類
    switch (movie_slice[0]) {
      case "bed1":
        movie_type = "ボディメカニクスを活用したベッドメーキング";
        break;
      case "bed2":
        movie_type = "臥症患者のベッドメーキング";
        break;
      case "Sterilization1":
        movie_type = "滅菌手袋の着脱編";
        break;
      case "Sterilization2":
        movie_type = "滅菌状態の確認と取り扱い編";
        break;
      case "Sterilization1":
        movie_type = "無菌操作・消毒綿球の作り方編";
        break;
      case "injection1":
        movie_type = "6R編";
        break;
      case "injection2":
        movie_type = "注射準備編";
        break;
      case "injection3":
        movie_type = "筋肉・皮下注射";
        break;
      default:
    }
    files = files +'<label><input type="button" id="'+array[i]+'"  value="'+ movie_type +'" onclick="getId2(this.id)"><\/label><label>撮影日時:'+y+'年'+m+'月'+d+'日<\/label><br>';
  }

  // document.getElementById('movie2').innerHTML = files;
  document.getElementById('others').innerHTML = files;
}


<script>
  $('#Myform3').submit(function(event) {
    // HTMLでの送信をキャンセル
    event.preventDefault();

    // 操作対象のフォーム要素を取得
    var $form = $(this);

    // 送信ボタンを取得
    var $button = $form.find('button');

    // 送信
    $.ajax({
        url: $form.attr('action'),
        type: $form.attr('method'),
        data: $form.serialize(),
        timeout: 10000,  // 単位はミリ秒

        // 送信前
        beforeSend: function(xhr, settings) {
            // ボタンを無効化し、二重送信を防止
            $button.attr('disabled', true);
        },
        // 応答後
        complete: function(xhr, textStatus) {
            // ボタンを有効化し、再送信を許可
            $button.attr('disabled', false);
        },

        // 通信成功時の処理
        success: function(result, textStatus, xhr) {
            // 入力値を初期化
            $form[0].reset();

            alert('OK');

            //ユーザ名取得
            var User = <?php echo json_encode($user); ?>;
            // 動画取得
            var array = <?php if(isset($movies))echo json_encode($movies); ?>;
            var files = '<h3>撮影した自身の映像一覧(クリックすることで表示されます)</h3><br>';
            //日付
            var y='', m='', d='';
            //動画の種類
            var movie_type = '';
            // Object.keys(array).length ->配列の長さ
            for(i=0;i<Object.keys(array).length;i++){
              var movie_slice = array[i].split("_");
              // console.log(movie_slice[0]);
              // console.log(movie_slice[1]);
              y = movie_slice[1].slice(0,4);
              m = movie_slice[1].slice(4,6);
              d = movie_slice[1].slice(6,8);
              //動画の種類
              switch (movie_slice[0]) {
                case "bed1":
                  movie_type = "ボディメカニクスを活用したベッドメーキング";
                  break;
                case "bed2":
                  movie_type = "臥症患者のベッドメーキング";
                  break;
                case "Sterilization1":
                  movie_type = "滅菌手袋の着脱編";
                  break;
                case "Sterilization2":
                  movie_type = "滅菌状態の確認と取り扱い編";
                  break;
                case "Sterilization1":
                  movie_type = "無菌操作・消毒綿球の作り方編";
                  break;
                case "injection1":
                  movie_type = "6R編";
                  break;
                case "injection2":
                  movie_type = "注射準備編";
                  break;
                case "injection3":
                  movie_type = "筋肉・皮下注射";
                  break;
                default:
              }
              files = files +'<label><input type="button" id="'+array[i]+'"  value="'+ movie_type +'" onclick="getId2(this.id)"><\/label><label>撮影日時:'+y+'年'+m+'月'+d+'日<\/label><br>';
            }
            document.getElementById('others').innerHTML = files;
        },

        // 通信失敗時の処理
        error: function(xhr, textStatus, error) {
            alert('NG...');
        }
    });
  });
</script>
