
<?php
session_start();//新しいセッションの作成
if(isset($_SESSION['users'])!=""){ //issetは変数やNULLのチェック、$_SESSIONは[]に保存したいセッション名
    //ログイン済みの場合home.phpへ転送
    header("Location:home.php");
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
  <h1>会員登録フォーム</h1>
  <div class="form-group">
    <label for="Inputusername">お名前</label>
    <input type="text" class="form-control" name="username" placeholder="山田　太郎" value="<?php if( !empty($_POST['username']) ){ echo $_POST['username']; } ?>"/>
  </div>
  <div class="form-group">
    <label for="Inputemail">メールアドレス</label>
    <input type="email"  class="form-control" name="email"  placeholder="xxx@yyy.zz"  value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>" required />
  </div>
  <div class="form-group">
    <label for="Inputpassward">パスワード</label>
    <input type="password" class="form-control" name="password" pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$" required />
    <small id="PasswardHelp" class="form-text text-muted">半角英数字８文字以上</small>
  </div>
  <div class="form-group">
    〒 <input type="text"  name="zip" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" placeholder="郵便番号" size="8" value="<?php if( !empty($_POST['zip']) ){ echo $_POST['zip']; } ?>" required /><br>
    <small id="ZipHelp" class="form-text text-muted">ハイフン無し。自動入力。</small>
    <label for="Inputaddredd">住所</label>
    <input type="text"  class="form-control" name="address"  value="<?php if( !empty($_POST['address']) ){ echo $_POST['address']; } ?>" required />
  </div>
  <button type="submit" class="btn btn-info mr-4" name="signup">会員登録する</button>
  <a href="signin.php" class="btn btn-outline-primary" role="button">ログインはこちら</a>


<?php
if(isset($_POST['signup'])) {

    
    //$mysqliはdbconnect.phpで定義済み

    $username = $mysqli->real_escape_string($_POST['username']);//real_escape_stringは特殊文字を扱えるように変換
    $email = $mysqli->real_escape_string($_POST['email']);//悪意あるユーザーから守る
    $password = $mysqli->real_escape_string($_POST['password']);
    $zip = $mysqli->real_escape_string($_POST['zip']);
    $address = $mysqli->real_escape_string($_POST['address']);

    $ck=check($username,$email,$password,$zip,$address,$mysqli);
    if ($ck != ""){    ?>
    
      <div class="alert alert-danger my-3" role="alert"><?php echo $ck;?></div>
    
<?php
    }

    if(empty($ck) && empty($b)) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    // POSTされた情報をDBに格納する
    $query = "INSERT INTO users(username,email,password,zip,address) VALUES('$username','$email','$password','$zip','$address')";
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