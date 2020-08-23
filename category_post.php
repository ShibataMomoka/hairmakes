
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
    <label>カテゴリ名</label>
    <input type="text" class="form-control" name="name"  value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>" required />
  </div>
  <button type="submit" class="btn btn-info mr-4" name="post">投稿する</button>
  <a href="manage_category.php" class="btn btn-outline-primary" role="button">戻る</a>

  
<?php
if(isset($_POST['post'])) {

    
    //$mysqliはdbconnect.phpで定義済み

    $name = $mysqli->real_escape_string($_POST['name']);//real_escape_stringは特殊文字を扱えるように変換
    $ck=check($name,'aa@aa.aa',aaaa1111,1,1,$mysqli);
    
    if ($ck != ""){    ?>
    
      <div class="alert alert-danger my-3" role="alert"><?php echo $ck;?></div>
    
<?php
    }

    if(empty($ck)) {

    // POSTされた情報をDBに格納する
    $query = "INSERT INTO categories(name) VALUES('$name')";
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success my-3" role="alert">登録しました</div>
      <?php } else { ?>
      <div class="alert alert-danger my-3" role="alert">エラーが発生しました。</div>
      <?php
    }

    }
} 

    

?>
</form>
</body>
</html>