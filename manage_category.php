<?php
ob_start();//？
session_start();
/*if(!isset($_SESSION['adminers'])){
    header("Location: home.php");
    exit;
}*/

include_once 'dbconnect.php';
include_once 'functions.php';

$max =1;

$query="SELECT COUNT(*) AS count FROM categories";
$result=$mysqli->query($query);//検索結果を入れる


if(!$result){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

//ユーザー情報の取り出し
while($row=$result->fetch_assoc()){//行を連想配列で返す
    $total_count=$row['count'];
}



$pages = ceil($total_count / $max);//ceilは端数切り上げ


//現在いるページのページ番号を取得
if(!isset($_GET['page_id'])){ //何もセットされていなかったら（初期値）
    $now = 1;
}else{
    $now = (INT)$_GET['page_id'];
}

if ($now > 1) {
	$start = ($now * $max) - $max;
} else {
	$start = 0;
}

$query2="SELECT * FROM categories ORDER BY id ASC LIMIT {$start},{$max}";
$result2=$mysqli->query($query2);

if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rows=$result2->fetch_assoc()){//行を連想配列で返す
    $data[]=$rows;
}



$mysqli->close();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <?php include 'mng_nav.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'mng_menu.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1>カテゴリ一覧</h1>
                <a class="btn btn-success my-3" href="category_post.php" role="bottun">新規投稿</a>
                <table class="table text-nowrap">
                    <tr>
                        <th>id</th>
                        <th>カテゴリ名</th>
                        <th>削除</th>
                        <th>変更</th>
                    </tr>

                    <?php foreach($data as $row){ ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo h($row['name']); ?></td>
                        <td>
                            <input type="submit" class="btn btn-primary" value="削除する"
                                onClick="sakujo2(<?php echo $row['id']; ?>)">


                        </td>
                        <td>
                            <form action="category_update.php" method="post">
                                <input type="submit" class="btn btn-primary" value="変更する">
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                            </form>
                        </td>
                    </tr>
                    <?php 
                    } 

                    ?>

                </table>
                <?php

                    for ( $n = 1; $n <= $pages; $n ++){
                        if ( $n == $now ){
                            echo "<span style='padding: 5px;'>$now</span>";
                        }else{
                            echo "<a href='./manage_category.php?page_id=$n' style='padding: 5px;'>$n</a>";
                        }
                    }

                    ?>
            </main>
        </div>
    </div>
</body>

</html>