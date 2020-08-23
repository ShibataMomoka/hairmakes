<?php
//ini_set( 'display_errors', 1 );
ob_start();//？
session_start();

include_once 'dbconnect.php';
include_once 'functions.php';

$category_id=$_GET['category_id'];
$user_id=$_SESSION['users'];


$max =2;

$query="SELECT COUNT(*) AS count FROM hairmakes WHERE category_id='$category_id'";
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

$query2="SELECT * FROM hairmakes WHERE category_id='$category_id' ORDER BY id ASC LIMIT {$start},{$max}";
$result2=$mysqli->query($query2);

if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rows=$result2->fetch_assoc()){//行を連想配列で返す
    $data[]=$rows;
}

$query3="SELECT * FROM categories WHERE id='$category_id' ";
$result3=$mysqli->query($query3);

if(!$result3){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rowss=$result3->fetch_assoc()){//行を連想配列で返す
    $name=$rowss['name'];
}



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="container-fulid ">
    <?php 
    if(isset($_SESSION['users'])){
        include 'my_nav.php';
    } else{
        include 'home_nav.php'; 
    }
    include 'home_menu.php';
    ?>
    </div>

    <main role="main" class="container">
        <h2><?php echo $name; ?></h2>
        <br><br>

        <div class="row mb-2">
        <?php foreach($data as $rows){ 
            
            ?>
            <div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="height:250px">
                    <div class="col p-4 d-flex flex-column position-static ">
                        <h3 class="mb-0"><?php echo  $rows['title']?></h3>
                        <a href="toukou.php?hairmake_id=<?php echo $rows['id'] ?>" >詳しく見る</a>    
                    </div>
                    <div class="col-auto d-none d-lg-block">
                    <?php $youtube_id=str_replace("https://www.youtube.com/watch?v=","",$rows['youtube']); ?>
                    <img src="http://img.youtube.com/vi/<?php echo $youtube_id; ?>/default.jpg" alt="サムネイル" 　width="100px" height="250px"><br>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div> 

        <?php

                    for ( $n = 1; $n <= $pages; $n ++){
                        if ( $n == $now ){
                            echo "<span style='padding: 5px;'>$now</span>";
                        }else{
                            echo "<a href='./catalog.php?page_id=$n&category_id=$category_id' style='padding: 5px;'>$n</a>";
                        }
                    }

                ?>
        <br><br>

    </main>



</body>

</html>