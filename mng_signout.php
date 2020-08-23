<?php
session_start();

if(isset($_GET['signout'])){
    session_destroy();//セッションに登録されたデータを破棄
    unset($_SESSION['adminers']);//指定の変数の割当解除
    header("Location:home.php");
} else {
    header("Location:manage_hairmake.php");
}
?>