<?php
ob_start();//？
session_start();



include_once 'dbconnect.php';
include_once 'functions.php';

$hairmake_id=$_GET['hairmake_id'];
$user_id=$_SESSION['users'];



$query="SELECT * FROM hairmakes WHERE id='$hairmake_id'";
$result=$mysqli->query($query);

if(!$result){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rows=$result->fetch_assoc()){//行を連想配列で返す
    $data[]=$rows;
    $category_id=$rows['category_id'];
}

$query2="SELECT * FROM categories WHERE id='$category_id' ";
$result2=$mysqli->query($query2);

if(!$result2){
    print('クエリーが失敗しました。'.$mysqli->error);
    $mysqli->close;
    exit();
}

while($rowss=$result2->fetch_assoc()){//行を連想配列で返す
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
            $message=$_SESSION['message'];
            $com_message=$_SESSION['com_message'];
            $sakujo=$_SESSION['sakujo'];
        } else{
            include 'home_nav.php';
        }
        include 'home_menu.php'
        
        ?>

    </div>
    <?php if($message!=""){?>
    <div class="alert-t alert-success my-3　text-center" role="alert"><?php echo $message; ?></div>
    <?php } if($com_message!=""){?>
    <div class="alert-t alert-danger my-3 text-center" role="alert"><?php echo $com_message; ?></div>
    <?php } if($sakujo!=""){?>
    <div class="alert-t alert-success my-3 text-center" role="alert"><?php echo $sakujo; ?></div><?php }?>
    <div class="categ">
        <h1><?php echo $name; ?></h1>
        <?php 
        unset($_SESSION['message']);
        unset($_SESSION['com_message']);
        unset($_SESSION['sakujo']);
        ?>
    </div>

    <main role="main" class="ml-sm-auto col-8 col-offset-2 px-4">

        <table class="table text-nowrap">


            <?php  foreach($data as $rows){
                $content=$rows['content'];
                $content=nl2br($content);
            ?>
    

            <h1><?php echo h($rows['title']); ?></h1>

            
            <?php $youtube_id=str_replace("https://www.youtube.com/watch?v=","",$rows['youtube']); ?>
            <img src="http://img.youtube.com/vi/<?php echo $youtube_id; ?>/default.jpg" alt="サムネイル" 　width="300px"
                height="280px"><br>
            <a href="<?php echo h($row['youtube']); ?>">動画はこちらから</a>
            <br><br><br>
            <h2>手順</h2>
            <div class="text-wrap"><?php echo $content ;?></div>
            <br><br><br>
            
                <?php $hairmake_id=$rows['id'];
                    $sql="SELECT * FROM favorites WHERE hairmake_id='$hairmake_id' and user_id='$user_id' ";
                    $sqlresult=$mysqli->query($sql);
                    if($sqlresult->num_rows == 0){
                    ?>
                <form action="user_favorite.php" method="post">

                    <input type="submit" class="btn btn-primary" value="お気に入り登録">
                    <input type="hidden" name="hairmake_id" value="<?php echo $rows['id'];?>">
                </form>
                <?php
                    } else { ?>
                <button class="btn btn-primary " role="button" disabled>お気に入り登録済み</button>
                <?php
                    }
                    ?>
            <br><br><br>
            <h2>コメント</h2>
            <?php

            $hairmake_id=$rows['id'];
            $sql="SELECT * FROM comments WHERE hairmake_id='$hairmake_id' ORDER BY id ";
            $stmt=$mysqli->query($sql);
            if(!$stmt){
                print('クエリーが失敗しました。'.$mysqli->error);
                $mysqli->close;
                exit();
            }
            while($c_rows=$stmt->fetch_assoc()){//行を連想配列で返す
                $c_data[]=$c_rows;
            }
            foreach($c_data as $c_rows){
                $comment_id=$c_rows['id'];
                $comment=$c_rows['comment'];
                $users_id=$c_rows['user_id'];
                $sql="SELECT * FROM users WHERE id='$users_id'";
                $stmt=$mysqli->query($sql);
                if(!$stmt){
                    print('クエリーが失敗しました。1'.$mysqli->error);
                    $mysqli->close;
                    exit();
                }
                while($row=$stmt->fetch_assoc()){//行を連想配列で返す
                    $username=$row['username'];
                }
                $sql2="SELECT * FROM replies WHERE comment_id='$comment_id'";
                $stmt2=$mysqli->query($sql2);
                if(!$stmt2){
                    print('クエリーが失敗しました。1'.$mysqli->error);
                    $mysqli->close;
                    exit();
                }
                while($r_row=$stmt2->fetch_assoc()){//行を連想配列で返す
                    $mng_content=$r_row['content'];
                }
                $mng_content=nl2br($mng_content);
                $comment=nl2br($comment);
            ?>
            <div>
            <p>投稿者：<?php echo $username; ?></p>
            <p>コメント：<?php echo $comment; ?></p>

            <?php if($user_id==$users_id){
                ?><div class="text-right"><input type="submit" class="btn btn-primary" value="削除する"
                    onClick="sakujo3(<?php echo $c_rows['id']; ?>,<?php echo $hairmake_id; ?>)">
            </div><br><?php
            }
            if($stmt2->num_rows != 0){
            ?><div class="text-center">
                <p><?php echo $username; ?>　様</p>
                <p>返信：<?php echo $mng_content; ?></p>
            </div>
            <?php
            } else{
                $mng_content="";
            }
            } 
            ?>
           </div>
            
            <form action="comment.php" class="form-post" method="post">
                <textarea rows="8" class="form-control form1" name="comment" 　value="コメントを記入する。" style="width:400px"></textarea>
                <br>
                <input type="hidden" name="hairmake_id" value="<?php echo $rows['id'];?>">
                <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                <button type="submit" class="btn btn-info mr-4" name="post">投稿する</button>
            </form>
        
            <?php 
                    } 
                    $mysqli->close();
                    ?>
        </table>
        
        <br><br>
    </main>


</body>

</html>