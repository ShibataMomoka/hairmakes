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
        $comment_id=$_GET['id'];
        $hairmake_id=$_GET['hairmake_id'];
        $user_id=$_SESSION['users'];
        $stmt = "DELETE FROM comments WHERE id='$comment_id ' and user_id='$user_id'";//プリペアドステートメント
        $result=$mysqli->query($stmt);

        if(!$result){
            $_SESSION['sakujo']="クエリーが失敗しました";
            header("Location: toukou.php?hairmake_id=$hairmake_id");
            print('クエリーが失敗しました。'.$mysqli->error);
            
            $mysqli->close;
            exit();
        } else{
            $_SESSION['sakujo']="コメントを解除しました";
            header("Location:toukou.php?hairmake_id=$hairmake_id");
            exit;

        }
    }



}
?>