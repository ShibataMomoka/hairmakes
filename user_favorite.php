<?php
ob_start();//？
session_start();

require_once('dbconnect.php');

if(!isset($_SESSION['users'])){
    header("Location: home.php");
    exit;
} else{


if (empty($_POST)){
    header("Location: manage_category.php");
    exit;
} else {
    if (!isset($_POST['hairmake_id']) || !is_numeric($_POST['hairmake_id'])){//is_numericは数字形式のものか判別
        echo "IDエラー";
        exit();
    } else {
        $user_id=$_SESSION['users'];
        $hairmake_id=$_POST['hairmake_id'];
        $query = "INSERT INTO favorites(user_id,hairmake_id) VALUES('$user_id','$hairmake_id')";
        $result2=$mysqli->query($query);
        if(!$result2){
            $_SESSION['message']="クエリーが失敗しました";
            header("Location: toukou.php?hairmake_id=$hairmake_id");
            print('クエリーが失敗しました。'.$mysqli->error);
            
            $mysqli->close;
            exit();
        } else{
            $_SESSION['message']="登録しました";
            header("Location: toukou.php?hairmake_id=$hairmake_id");
            exit;

        }

        

            
            
            
          
        
    
}
}
}

$mysqli->close();

?>