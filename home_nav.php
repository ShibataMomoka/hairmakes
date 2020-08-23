
    <div class="row ">
        <nav class="navbar navbar-expand-sm fixed-top flex-nowrap navbar-dark  p-1" style="background-color:#ff8484; ">
            
                <a class="navbar-brand col-sm-3 col-md-2 " href="home.php">ヘアメイク　ホーム</a>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#Navber"
                    aria-controls="Navber" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end mr-auto" id="Navber">
                <form  action="home.php" method="post" class="form-inline  flex-nowrap" >
                        <input  type="text" name="search" class="form-control mr-sm-2" placeholder="キーワード" value="<?php if($_POST['search']!="" ){echo $_POST['search']; } ?>">
                        <input  type="submit" class="btn btn-info text-nowrap my-0 " name="submit" value="検索">
                </form>
                    <ul class="navbar-nav">

                        <li class="nav-item active text-nowrap">
                            <a class="nav-link" href="register.php">新規登録</a>
                        </li>
                        <li class="nav-item active text-nowrap">
                            <a class="nav-link" href="signin.php">ログイン</a>
                        </li>
                    </ul>
            </div>

        </nav>
        
        
    </div>
    

                

    
