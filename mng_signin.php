<?php
ini_set( 'display_errors', 1 );

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
  <h1>ログインフォーム</h1>
  <div class="form-group">
    <label for="Inputname">お名前</label>
    <input type="text" class="form-control" name="name" placeholder="山田　太郎" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>"/>
  </div>
  <div class="form-group">
    <label for="Inputpassward">パスワード</label>
    <input type="password" class="form-control" name="password" pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$" required />
    <small id="PasswardHelp" class="form-text text-muted">半角英数字８文字以上</small>
  </div>
  <button type="submit" class="btn btn-info mr-4" name="login">ログインする</button>
  <a href="home.php" class="btn btn-outline-primary" role="button">ホームページへ戻る</a>


<?php
//ログインボタンがクリックされた時
if(isset($_POST['login'])){ 
    
    

        $name=$mysqli->real_escape_string($_POST['name']);
        $password=$mysqli->real_escape_string($_POST['password']);

        //クエリの実行（検索）
        $query="SELECT * FROM adminers WHERE name='$name'";
        $result=$mysqli->query($query);
        if (!$result){
            print('クエリーが失敗しました。'.$mysqli->error);
            $mysqli->close();
            exit();
        }
        

        //暗号化済みパスワードとユーザーIDの取り出し
        while($row=$result->fetch_assoc()){
            $db_hashed_pwd=$row['password'];
            $id=$row['id'];
        }

        //データベースの切断
        $result->close();

        //ハッシュ化されたパスワードがマッチするか
        if (password_verify($password,$db_hashed_pwd)){
            $_SESSION['adminers']=$id;
            header("Location:manage_hairmake.php");
            exit;
        } else { ?>
        <div class="alert alert-danger my-3" role="alert">お名前とパスワードが一致しません。</div>
        <?php
        
        }
    }


?>

</form>
</body>
</html>