
<?php
session_start();//新しいセッションの作成
if(isset($_SESSION['adminers'])!=""){ //issetは変数やNULLのチェック、$_SESSIONは[]に保存したいセッション名
    //ログイン済みの場合home.phpへ転送
    header("Location:manage_hairmake.php");
    exit;
}

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
<form class="form-register" method="post" novalidate>
  <h1>登録フォーム</h1>
  <div class="form-group">
    <label for="Inputname">お名前</label>
    <input type="text" class="form-control" name="name" placeholder="山田　太郎" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>"/>
  </div>
  <div class="form-group">
    <label for="Inputpassward">パスワード</label>
    <input type="password" class="form-control" name="password" pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$" required />
    <small id="PasswardHelp" class="form-text text-muted">半角英数字８文字以上</small>
  </div>
  <button type="submit" class="btn btn-info mr-4" name="signup">会員登録する</button>
  <a href="mng_signin.php" class="btn btn-outline-primary" role="button">ログインはこちら</a>


<?php
if(isset($_POST['signup'])) {

    
    //$mysqliはdbconnect.phpで定義済み

    $name = $mysqli->real_escape_string($_POST['name']);//real_escape_stringは特殊文字を扱えるように変換
    $password = $mysqli->real_escape_string($_POST['password']);
    

    $ck=check($name,'aa@aa.aa',$password,1,1,$mysqli);
    if ($ck != ""){    ?>
    
      <div class="alert alert-danger my-3" role="alert"><?php echo $ck;?></div>
    
<?php
    }

    if(empty($ck) && empty($b)) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    // POSTされた情報をDBに格納する
    $query = "INSERT INTO adminers(name,password) VALUES('$name','$password')";
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