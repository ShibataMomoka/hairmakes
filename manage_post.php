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

$query2="SELECT * FROM categories ";
$result2=$mysqli->query($query2);

if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rows=$result2->fetch_assoc()){//行を連想配列で返す
    $data[]=$rows;
}





?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <form class="form-post" method="post" novalidate>
        <h1>管理者用投稿フォーム</h1>
        <div class="form-group">
            <label for="select">カテゴリ名</label>
            <select id="select" class="form-control" name="category_id">
                <?php foreach($data as $rows){ ?>
                <option value=<?php echo $rows['id'] ;?>><?php echo h($rows['name']) ;?></option>
                <?php } ?>
            </select>
            <a href="category_post.php"  >新規カテゴリ作成はこちら</a>
        </div>
        <div class="form-group">
            <label>タイトル</label>
            <input type="text" class="form-control" name="title"
                value="<?php if( !empty($_POST['title']) ){ echo $_POST['title']; } ?>" required />
        </div>
        <div class="form-group">
            <label>説明文</label>
            <textarea rows="8" class="form-control" name="content"
                value="<?php if( !empty($_POST['content']) ){ echo $_POST['content']; } ?>" required></textarea>
        </div>
        <div class="form-group">
            <label>YouTubeのURL</label>
            <input type="url" class="form-control" name="youtube"
                value="<?php if( !empty($_POST['youtube']) ){ echo $_POST['youtube']; } ?>" required />
        </div>
        <button type="submit" class="btn btn-info mr-4" name="post">投稿する</button>
        <a href="manage_hairmake.php" class="btn btn-outline-primary" role="button">戻る</a>


        <?php
if(isset($_POST['post'])) {

    
    //$mysqliはdbconnect.phpで定義済み
    $category_id = $mysqli->real_escape_string($_POST['category_id']);
    $title = $mysqli->real_escape_string($_POST['title']);    
    $content = $mysqli->real_escape_string($_POST['content']);
    $youtube= $mysqli->real_escape_string($_POST['youtube']);

    
    
    $cp=p_ck($title,$content,$youtube);
    
    if ($cp != ""){    ?>

        <div class="alert alert-danger my-3" role="alert"><?php echo $cp;?></div>

        <?php
    }

    if(empty($cp) && $category_id != "") {

    // POSTされた情報をDBに格納する
    $query = "INSERT INTO hairmakes(title,content,youtube,category_id) VALUES('$title','$content','$youtube','$category_id')";
    if($mysqli->query($query)) {  ?>
        <div class="alert alert-success my-3" role="alert">登録しました</div>
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