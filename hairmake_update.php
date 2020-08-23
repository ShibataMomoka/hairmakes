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
	header("Location: manage_hairmake.php");
    exit;
}else{
	if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
		echo "IDエラー";
		exit();
	}else{
        
        $id = $_POST['id'];
        $stmt = "SELECT * FROM hairmakes WHERE id={$id}";
        $result=$mysqli->query($stmt);

        if(!$result){
            print('クエリーが失敗しました。'.$mysqli->error);
            $mysqli->close;
            exit();
        }
        
        $data=$result->fetch_assoc();//行を連想配列で返す

        $query2="SELECT * FROM categories ";
        $result2=$mysqli->query($query2);

        if(!$result2){
            print('クエリーが失敗しました。'.$mysqli->error);
            $mysqli->close;
            exit();
        }

        while($rows=$result2->fetch_assoc()){//行を連想配列で返す
            $datas[]=$rows;
        }
			
			
						
			
		
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
            <label for="select">カテゴリ名</label>
            <select id="select" class="form-control" name="name">
                <?php foreach($datas as $rows){ ?>
                <option><?php echo h($rows['name']) ;?></option>
                <?php } ?>
            </select>
            <a href="category_post.php"  >新規カテゴリ作成はこちら</a>
        </div>
        <div class="form-group">
            <label>タイトル</label>
            <input type="text" class="form-control" name="title"  value="<?php if( !empty($_POST['title']) ){ echo $_POST['title']; }else{ echo h($data['title']); }?>" required />
        </div>
        <div class="form-group">
            <label>説明文</label>
            <textarea rows="8" class="form-control" name="content" required><?php if( !empty($_POST['content']) ){ echo $_POST['content']; }else{ echo h($data['content']);} ?></textarea>
        </div>
        <div class="form-group">
            <label>YouTubeのURL</label>
            <input type="url" class="form-control" name="youtube" value="<?php if( !empty($_POST['youtube']) ){ echo $_POST['youtube']; }else{ echo h($data['youtube']);} ?>" required />
        </div>
        <input type="hidden" name="id" value="<?php echo $data['id'];?>">
        <button type="submit" class="btn btn-info mr-4" name="update">変更する</button>
        <a href="manage_hairmake.php" class="btn btn-outline-primary" role="button">管理者画面へ戻る</a>



        <?php
        
        if(isset($_POST['update'])) {
            $id=$_POST['id'];
            $name = $mysqli->real_escape_string($_POST['name']);
            $title = $mysqli->real_escape_string($_POST['title']);
            $content = $mysqli->real_escape_string($_POST['content']);
            $youtube= $mysqli->real_escape_string($_POST['youtube']);

            $query="SELECT * FROM categories WHERE name='$name'";
            $result=$mysqli->query($query);
            if (!$result){
                print('クエリーが失敗しました。'.$mysqli->error);
                $mysqli->close();
                exit();
            }
            while($row=$result->fetch_assoc()){
            $category_id=$row['id'];
            }
            
            $cp=p_ck($title,$content,$youtube);
            
            if ($cp != ""){    ?>

                <div class="alert alert-danger my-3" role="alert"><?php echo $cp;?></div>

                <?php
            }

            if(empty($cp) && $category_id != "") {
            $stmt = "UPDATE hairmakes SET title='$title',content='$content',youtube='$youtube',category_id='$category_id' WHERE id='$id'";
            
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