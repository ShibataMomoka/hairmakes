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

$query="SELECT COUNT(*) AS count FROM comments";
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

$query2="SELECT * FROM comments ORDER BY id ASC LIMIT {$start},{$max}";
$result2=$mysqli->query($query2);

if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rows=$result2->fetch_assoc()){//行を連想配列で返す
    $data[]=$rows;
}






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
                <h1>コメント一覧</h1>
                <table class="table text-nowrap">
                    <tr>
                        <th>id</th>
                        <th>投稿者</th>
                        <th>タイトル</th>
                        <th>コメント</th>
                        <th>削除</th>
                        <th>返信</th>
                    </tr>

                    <?php 
                    foreach($data as $row){ 
                        $hairmake_id=$row['hairmake_id'];
                        $user_id=$row['user_id'];
                        $comment_id=$row['id'];
                        $comment=$row['comment'];
                        $sql="SELECT * FROM users WHERE id='$user_id' ";
                       
                        $stmt=$mysqli->query($sql);
                        if(!$stmt){
                            print('クエリーが失敗しました。1'.$mysqli->error);
                            $mysqli->close;
                            exit();
                        }
                        while($c_rows=$stmt->fetch_assoc()){//行を連想配列で返す
                            $username=$c_rows['username'];
                        }
                        
                        $sql="SELECT * FROM hairmakes WHERE id='$hairmake_id' ";
                        $stmt=$mysqli->query($sql);
                        if(!$stmt){
                            print('クエリーが失敗しました。'.$mysqli->error);
                            $mysqli->close;
                            exit();
                        }
                        while($h_rows=$stmt->fetch_assoc()){//行を連想配列で返す
                            $title=$h_rows['title'];
                        }
                        ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo h($username); ?></td>
                        <td><?php echo h($title); ?></td>
                        <td><?php echo h($comment); ?></td>

                        <td>
                            <input type="submit" class="btn btn-primary" value="削除する"
                                onClick="sakujo2(<?php echo $row['id']; ?>)">


                        </td>
                        <td>
                            <?php 
                            $query3="SELECT * FROM replies WHERE comment_id='$comment_id'";
                            $result3=$mysqli->query($query3);
                            
                            if(!$result3){
                                print('クエリーが失敗しました。'.$mysqli->error);
                                $mysqli->close;
                                exit();
                            }
                             
                                       
                            if($result3->num_rows==0){
                            ?>
                            <form action="comment_update.php" method="post">
                                <input type="submit" class="btn btn-primary" value="返信する">
                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                            </form>
                            <?php } else{ ?>
                                <button type="button" class="btn btn-primary " disabled>返信済み</button>
                        <?php } ?>
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
                            echo "<a href='./manage_comment.php?page_id=$n' style='padding: 5px;'>$n</a>";
                        }
                    }
                    $mysqli->close();
                    ?>
            </main>
        </div>
    </div>
</body>

</html>