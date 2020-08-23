<?php
 ob_start();//？
 session_start();

 /*if(!isset($_SESSION['adminers'])){
    header("Location: admin.php");
    exit;
}*/
 
 include_once 'dbconnect.php';
 include_once 'functions.php';
 
if(empty($_POST)) {
	header("Location: manage_category.php");
    exit;
}else{
	if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
		echo "IDエラー";
		exit();
	}else{
        
        $id = $_POST['id'];
        $stmt = "SELECT * FROM categories WHERE id={$id}";
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
        <h1>管理者用更新フォーム</h1>
        <div class="form-group">
            <label>カテゴリ名</label>
            <input type="text" class="form-control" name="name"  value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; }else{ echo h($data['name']); }?>" required />
        </div>
        <input type="hidden" name="id" value="<?php echo $data['id'];?>">
        <button type="submit" class="btn btn-info mr-4" name="update">変更する</button>
        <a href="manage_category.php" class="btn btn-outline-primary" role="button">管理者画面へ戻る</a>



        <?php
        
        if(isset($_POST['update'])) {
            $id=$_POST['id'];
            $name = $mysqli->real_escape_string($_POST['name']);
            
            $ck=check($name,'aa@aa.aa',aaaa1111,1,1,$mysqli);
            
            if ($ck != ""){    ?>

                <div class="alert alert-danger my-3" role="alert"><?php echo $ck;?></div>

                <?php
            }

            if(empty($ck)) {
            
                //プリペアドステートメント
            $stmt = "UPDATE categories SET name='$name' WHERE id='$id'";
            
                if($mysqli->query($stmt)) {  ?>
                <div class="alert alert-success my-3" role="alert">変更しました。</div>
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