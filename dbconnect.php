<?php
require ('./core/my_config.php');//includeとほぼ同じ。エラー時スクリプト止まる

$mysqli=new mysqli($host,$username,$password,$dbname);
if ($mysqli->connect_error){//$mysqli->connect_errorはエラー内容を表す文字列を返す
    error_log($mysqli->connect_error);//error_log()はエラーメッセージをWeb サーバーのエラーログあるいはファイルに送る
    exit;
}


?>
