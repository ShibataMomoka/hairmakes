<?php
//ini_set( 'display_errors', 1 );
ob_start();//？
session_start();

include_once 'dbconnect.php';
include_once 'functions.php';


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

    <?php
    if($_POST['search']!=""){
        $query="SELECT * FROM hairmakes WHERE title LIKE '%".$_POST["search"]."%' OR content LIKE '%".$_POST["search"]."%' ";
        $result=$mysqli->query($query);

        if(!$result){
            print('クエリーが失敗しました。'.$mysqli->error);
            $mysqli->close;
            exit();
        }

        while($rows=$result->fetch_assoc()){//行を連想配列で返す
            $data[]=$rows;
        }
    } else{
        $query2="SELECT * FROM hairmakes ORDER BY id ";
        $result2=$mysqli->query($query2);

        if(!$result2){
            print('クエリーが失敗しました。'.$mysqli->error);
            $mysqli->close;
            exit();
        }

        while($row=$result2->fetch_assoc()){//行を連想配列で返す
            $data[]=$row;
        }
    }
        ?>

        <div class="row mb-2">
        <?php foreach($data as $row){ 
            
            ?>
            <div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" style="height:250px">
                    <div class="col p-4 d-flex flex-column position-static ">
                        <strong class="d-inline-block mb-2 text-primary">ピックアップ</strong>
                        <h3 class="mb-0"><?php echo  $row['title']?></h3>
                        <a href="toukou.php?hairmake_id=<?php echo $row['id'] ?>" >詳しく見る</a>    
                    </div>
                    <div class="col-auto d-none d-lg-block">
                    <?php $youtube_id=str_replace("https://www.youtube.com/watch?v=","",$row['youtube']); ?>
                    <img src="http://img.youtube.com/vi/<?php echo $youtube_id; ?>/default.jpg" alt="サムネイル" 　width="100px" height="250px"><br>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div> 

       
    </main>



</body>

</html>