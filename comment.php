<?php
ini_set( 'display_errors', 1 );
ob_start();//？
session_start();

require_once('dbconnect.php');
require 'functions.php';

if(!isset($_SESSION['users'])){
    header("Location: home.php");
    exit;
}

if(isset($_POST['post'])) {
    $user_id=$_SESSION['users'];
    $category_id=$_POST['category_id'];
    if(!isset($user_id)){
        $_SESSION['com_message']="コメントするにはログインが必要です";
        header("Location: toukou.php?category_id=$category_id");
        exit;
    } else{
        
    $comment=$_POST['comment'];
    
    $comment = $mysqli->real_escape_string($comment);//real_escape_stringは特殊文字を扱えるように変換
    $hairmake_id=$mysqli->real_escape_string($_POST['hairmake_id']);
    
    $ck=cm_ck($comment);
    if ($ck != ""){   
        $_SESSION['com_message']="コメント文がありません";
        header("Location: toukou.php?hairmake_id=$hairmake_id");
        exit;
    }

    if(empty($ck)) {
    
    $query = "INSERT INTO comments(user_id,hairmake_id,comment) VALUES('$user_id','$hairmake_id','$comment')";
    $result=$mysqli->query($query);
    if(!$result){
        $_SESSION['message']="クエリーが失敗しました";
        header("Location: toukou.php?hairmake_id=$hairmake_id");
        print('クエリーが失敗しました。'.$mysqli->error);
        
        $mysqli->close;
        exit();
    } else{
        $_SESSION['message']="コメントを投稿しました";
        header("Location: toukou.php?hairmake_id=$hairmake_id");
        exit;
    
    }
    }
    } 
}
?>