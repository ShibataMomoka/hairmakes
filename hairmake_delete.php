<?php
ob_start();//？
session_start();

require_once('dbconnect.php');

/*if(!isset($_SESSION['adminers'])){
    header("Location: admin.php");
    exit;
}*/

if (empty($_GET)){
    header("Location: manage_hairmake.php");
    exit;
} else {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])){//is_numericは数字形式のものか判別
        echo "IDエラー";
        exit();
    } else {
        
        $stmt = $mysqli->prepare("DELETE FROM hairmakes WHERE id=?");//プリペアドステートメント

        if($stmt){
            $id=$_GET['id'];
            $stmt->bind_param('i', $id);//プリペアドステートメントのパラメータに変数をバインド（関連づける）する
            

            $stmt->execute();//プリペアドステートメントの実行

            //変更された行の数が1かどうか
			if($stmt->affected_rows == 1){
                echo "削除いたしました。";
                echo "<br>";
                echo "<a href='manage_hairmake.php'>投稿一覧に戻る</a>";
			}else{
                echo "削除失敗です";
                echo "<br>";
                echo "<a href='manage_hairmake.php'>投稿一覧に戻る</a>";
            }
            
            $stmt->close();
        } else {
            echo $mysqli->errno . $mysqli->error;
        }
    }
}

$mysqli->close();

?>