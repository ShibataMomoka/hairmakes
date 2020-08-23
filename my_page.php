<?php
ob_start();//？
session_start();

if(!isset($_SESSION['users'])){
    header("Location: home.php");
    exit;
}

include_once 'dbconnect.php';
include_once 'functions.php';

$max=1;

$user_id=$_SESSION['users'];

$sql="SELECT COUNT(*) AS count FROM favorites WHERE user_id='$user_id' ";
$qresult=$mysqli->query($sql);//検索結果を入れる
  


if(!$qresult){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}


//ユーザー情報の取り出し
while($qrow=$qresult->fetch_assoc()){//行を連想配列で返す
    $total_count=$qrow['count'];
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



$query="SELECT * FROM users WHERE id='$user_id'";
$result=$mysqli->query($query);

if(!$result){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($row=$result->fetch_assoc()){//行を連想配列で返す
    $data[]=$row;
}


$query2="SELECT * FROM favorites WHERE user_id='$user_id' ORDER BY id ASC LIMIT {$start},{$max}";
$result2=$mysqli->query($query2);


if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($row2=$result2->fetch_assoc()){//行を連想配列で返す
    $hairmake_id=$row2['hairmake_id'];
}


$query3="SELECT * FROM hairmakes WHERE id='$hairmake_id' ORDER BY id ";
$result3=$mysqli->query($query3);



if(!$result3){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($row3=$result3->fetch_assoc()){//行を連想配列で返す
    $data3[]=$row3;
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <?php
    $kaijo=$_SESSION['kaijo'];
    if($kaijo!=""){
    ?>
    <div class="alert-u alert-success my-3　text-center" role="alert"><?php echo $kaijo; ?></div>
    <?php }
    unset($_SESSION['kaijo']); ?>
    <dic class="container-fulid">
        <div class="jumbotron jumbotron-extend mt-0">
            <a href="home.php">ホームに戻る</a>
        </div>
        </div>


        <?php  foreach($data as $row){ ?>
        <div class="container">
            <div class="row">
                <h3><?php echo $row['username']; ?> 様</h3>
                <form action="my_config.php" method="post">
                <input type="submit" class="btn btn-outline-secondary rounded-pill mx-3" value="設定">
                <input type="hidden" name="id" value="<?php echo $user_id;?>">
                </form>
            </div>
            <p><?php echo $row['email']; ?></p>
        </div>
        <?php } ?>
        
        
        <div class="container-fluid">

            <nav class="mt-5  navbar-dark  p-0" style="background-color:#ff8484;">
                <ul class="nav nav-tabs nav-justified" style="padding-bottom:0px;">
                    <li class="nav-item" style="background-color:#ffc493;">
                        <a class="nav-link active" data-toggle="tab" id="item1-tab" role="tab" area-controls="item1"
                            href="#item1" area-selected="false">お気に入り</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="item1" role="tabpanel" area-labelledby="item1-tab">
                        <div class="ml-sm-auto col-8 col-offset-2 px-4">
                        <table class="table text-nowrap ">
                            <?php  foreach($data3 as $row3){ ?>
                            <h1><?php echo h($row3['title']); ?></h1>
                            <?php $youtube_id=str_replace("https://www.youtube.com/watch?v=","",$row3['youtube']); ?>
                            <img src="http://img.youtube.com/vi/<?php echo $youtube_id; ?>/default.jpg" alt="サムネイル"
                                　width="300px" height="280px"><br>
                            <a href="<?php echo h($row3['youtube']); ?>">動画はこちらから</a>
                            <br><br><br>
                            <h2>手順</h2>
                            <div class="text-wrap"><?php echo h($row3['content']); ?></div>
                            <br><br><br>
                            
                            <input type="submit" class="btn btn-primary" value="お気に入り解除" onClick="kaijo(<?php echo $row3['id']; ?>)">
                           
                            
                                
                            <?php } ?>

                        </table>
                        <?php

                    for ( $n = 1; $n <= $pages; $n ++){
                        if ( $n == $now ){
                            echo "<span style='padding: 5px;'>$now</span>";
                        }else{
                            echo "<a href='./my_page.php?page_id=$n' style='padding: 5px;'>$n</a>";
                        }
                    }

                    ?>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="item2" role="tabpanel" area-labelledby="item2-tab">This is a text of
                        item#2.</div>
                    <div class="tab-pane fade" id="item3" role="tabpanel" area-labelledby="item3-tab">This is a text of
                        item#3.</div>
                </div>
            </nav>

        </div>



</body>

</html>