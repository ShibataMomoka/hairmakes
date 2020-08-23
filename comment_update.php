<?php
/*session_start();//新しいセッションの作成
if(isset($_SESSION['users'])!=""){ //issetは変数やNULLのチェック、$_SESSIONは[]に保存したいセッション名
    //ログイン済みの場合home.phpへ転送
    header("Location:home.php");
    exit;
}*/

include_once 'dbconnect.php';
include_once 'functions.php';
//include_onceは一度だけファイルを読み込む

$comment_id=$_POST['id'];

$query2="SELECT * FROM comments WHERE id='$comment_id' ";
$result2=$mysqli->query($query2);

if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rows=$result2->fetch_assoc()){//行を連想配列で返す
    $user_id=$rows['user_id'];
    $hairmake_id=$rows['hairmake_id'];
    $comment=$rows['comment'];
}


$sql="SELECT * FROM users WHERE id='$user_id' ";
$stmt=$mysqli->query($sql);
if(!$stmt){
    print('クエリーが失敗しました。1'.$mysqli->error);
    $mysqli->close;
    exit();
}
while($c_rows=$stmt->fetch_assoc()){//行を連想配列で返す
    $username=$c_rows['username'];
}

$sql="SELECT * FROM hairmakes WHERE id='$hairmake_id' ";
$stmt=$mysqli->query($sql);
if(!$stmt){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}
while($h_rows=$stmt->fetch_assoc()){//行を連想配列で返す
    $title=$h_rows['title'];
    $category_id=$h_rows['category_id'];
}                        





?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <form class="form-post" method="post" novalidate>
        <h1>管理者用返信フォーム</h1>
        <p>投稿者:<?php echo h($username); ?></p>
        <p>タイトル:<?php echo h($title); ?></p>
        <p>コメント:<?php echo h($comment); ?></p>
        <div class="form-group">
            <label>コメント</label>
            <textarea rows="8" class="form-control" name="content"
                value="<?php if( !empty($_POST['content']) ){ echo $_POST['content']; } ?>" required></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $comment_id;?>">
        <button type="submit" class="btn btn-info mr-4" name="post">投稿する</button>
        <a href="manage_comment.php" class="btn btn-outline-primary" role="button">戻る</a>


        <?php
if(isset($_POST['post'])) {
    

    //$mysqliはdbconnect.phpで定義済み
    $content = $mysqli->real_escape_string($_POST['content']);
    
    
    $cp=cm_ck($content);
    
    if ($cp != ""){    ?>

        <div class="alert alert-danger my-3" role="alert"><?php echo $cp;?></div>

        <?php
    }

    if(empty($cp)) {
        
    // POSTされた情報をDBに格納する
    $query = "INSERT INTO replies(comment_id,content) VALUES('$comment_id','$content')";
   
    if($mysqli->query($query)) {  ?>
        <div class="alert alert-success my-3" role="alert">返信しました</div>
        <?php } else { ?>
        <div class="alert alert-danger my-3" role="alert">エラーが発生しました。</div>
        <?php
    }

    }
} 

    
$mysqli->close();
?>
    </form>
</body>

</html>