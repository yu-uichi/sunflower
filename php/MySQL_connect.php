<?php

  header('Content-type: text/html; charset=UTF-8');
  //utf8でMyySQL使いたいでござる
  mb_language("uni");
  mb_internal_encoding("utf-8");
  mb_http_input("auto");
  mb_http_output("utf-8");

  //データベース接続
  $server = "mysql2105.xserver.jp";
  $userName = "teamdigicom_sun";
  $password = "3FloWer3";
  $dbName = "teamdigicom_sunflower";

  //MAMP用
  // $server = 'localhost';
  // $userName = 'root';
  // $password = 'root';
  // $dbName = "teamdigicom_sunflower";

  $mysqli = new mysqli($server,$userName,$password,$dbName);

  if ($mysqli->connect_error){
  	echo $mysqli->connect_error;
  	exit();
  }else{
  	$mysqli->set_charset("utf8");
  }
?>
