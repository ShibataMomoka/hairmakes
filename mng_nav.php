
<nav class="navbar navbar-expand-sm flex-nowrap  fixed-top navbar-dark  p-0" style="background-color:#ff8484; ">
    
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="manage_hairmake.php">ヘアメイク</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
                <form  action="manage_hairmake.php" method="post" class="form-inline  flex-nowrap">
                        <input  type="text" name="search" class="form-control mr-sm-2" placeholder="キーワード" value="<?php if($_POST['search']!=""  || $_GET['keywords']!=""){echo $_POST['search']; echo $_GET['keywords'];} ?>">
                        <input  type="submit" class="btn btn-info text-nowrap my-0 " name="submit" value="検索">
                </form>
            <ul class="navbar-nav">

                <li class="nav-item active text-nowrap">
                    <a class="nav-link" href="mng_signout.php?signout">ログアウト</a>
                </li>
            </ul>
        </div>
    
  </nav>
  <br><br>

                