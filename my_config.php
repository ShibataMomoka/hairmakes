<?php
 ob_start();//？
 session_start();

 if(!isset($_SESSION['users'])){
    header("Location: home.php");
    exit;
}
 
 include_once 'dbconnect.php';
 include_once 'functions.php';
 
if(empty($_POST)) {
	header("Location: my_page.php");
    exit;
}else{
	if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
		echo "IDエラー";
		exit();
	}else{
        
        $id = $_POST['id'];
        $stmt = "SELECT * FROM users WHERE id={$id}";
        $result=$mysqli->query($stmt);

        if(!$result){
            print('クエリーが失敗しました。'.$mysqli->error);
            $mysqli->close;
            exit();
        }

        $data=$result->fetch_assoc();//行を連想配列で返す			
		
	}
}
 
// データベース切断

 
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    

    <form class="form-post" method="post" novalidate>
        <h1>ユーザー情報変更画面</h1>
        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" class="form-control" name="username"  value="<?php if( !empty($_POST['username']) ){ echo $_POST['username']; }else{ echo h($data['username']); }?>" required />
        </div>
        <div class="form-group">
            <label>メールアドレス</label>
            <input type="text" class="form-control" name="email"  value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; }else{ echo h($data['email']); }?>" required />
        </div>
        <div class="form-group">
            <label>郵便番号</label>
            <input type="text" class="form-control" name="zip" style="width:100px" value="<?php if( !empty($_POST['zip']) ){ echo $_POST['zip']; }else{ echo h($data['zip']); }?>" required />
        </div>
        <div class="form-group">
            <label>住所</label>
            <input type="text" class="form-control" name="address"  value="<?php if( !empty($_POST['address']) ){ echo $_POST['address']; }else{ echo h($data['address']); }?>" required />
        </div>
        
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <button type="submit" class="btn btn-info mr-4" name="update">変更する</button>
        <a href="my_page.php" class="btn btn-outline-primary" role="button">マイページへ戻る</a>



        <?php
        
        if(isset($_POST['update'])) {
            $id=$_POST['id'];
            $username = $mysqli->real_escape_string($_POST['username']);
            $email = $mysqli->real_escape_string($_POST['email']);
            $zip = $mysqli->real_escape_string($_POST['zip']);
            $address= $mysqli->real_escape_string($_POST['address']);

            $stmt = "UPDATE users SET username='$username',email='$email',zip='$zip',address='$address' WHERE id='$id'";
            
                if($mysqli->query($stmt)) {  ?>
                <div class="alert alert-success my-3" role="alert">変更しました。</div>
                <?php } else { ?>
                <div class="alert alert-danger my-3" role="alert">エラーが発生しました。</div>
                <?php
                }
            
        }
        $mysqli->close();
        ?>
    </form>

</body>

</html>