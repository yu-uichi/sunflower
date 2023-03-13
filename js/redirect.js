var $ua = navigator.userAgent;
$(function(){
	//スマホユーザの場合、音声と同期させた動画再生をする
    if($ua.indexOf('iPhone') > 0 || $ua.indexOf('iPad') > 0 || $ua.indexOf('iPod') > 0 || $ua.indexOf('android') > 0 || $ua.indexOf('BlackBerry') > 0 || $ua.indexOf('windows Phone') > 0 || $ua.indexOf('NOKIA') > 0 || /Mobile.*Firefox/.test($ua)){
			//スマホユーザON
      location.href="./../php/video_smartphone.php";
		}
});
