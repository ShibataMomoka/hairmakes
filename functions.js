function sakujo(id){
    if (id == ""){
        location.href="manage_hairmake.php";
    } else {
        if(confirm("削除してもいいですか？") == true){
            location.href="hairmake_delete.php?id="+id;

        } 
    }
}

function sakujo2(id){
    if (id == ""){
        location.href="manage_category.php";
    } else {
        if(confirm("削除してもいいですか？") == true){
            location.href="category_delete.php?id="+id;

        } 
    }
}

function sakujo3(id,c){
    if (id == ""){
        location.href="home.php";
    } else {
        if(confirm("削除してもいいですか？") == true){
            location.href="users_comment_delete.php?id="+id+"&hairmake_id="+c;

        } 
    }
}

function kaijo(id){
    if (id == ""){
        location.href="my_page.php";
    } else {
        if(confirm("お気に入りを解除してもいいですか？") == true){
            location.href="user_disfavorite.php?id="+id;

        } 
    }
}