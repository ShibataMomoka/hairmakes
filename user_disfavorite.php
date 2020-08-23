<?php
ob_start();//？
session_start();

require_once('dbconnect.php');

if(!isset($_SESSION['users'])){
    header("Location: my_page.php");
    exit;
}

if (empty($_GET)){
    header("Location: my_page.php");
    exit;
} else {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])){//is_numericは数字形式のものか判別
        echo "IDエラー";
        exit();
    } else {
        $hairmake_id=$_GET['id'];
        $user_id=$_SESSION['users'];
        $stmt = "DELETE FROM favorites WHERE user_id='$user_id ' and hairmake_id='$hairmake_id'";//プリペアドステートメント
        $result=$mysqli->query($stmt);

        if(!$result){
            $_SESSION['kaijo']="クエリーが失敗しました";
            header("Location: my_page.php");
            print('クエリーが失敗しました。'.$mysqli->error);
            
            $mysqli->close;
            exit();
        } else{
            $_SESSION['kaijo']="お気に入り解除しました";
            header("Location: my_page.php");
            exit;

        }
    }



}
?>