<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Sample</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="jumbotron">
</div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">ブランド</a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="Navber">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">ホーム <span class="sr-only">(現位置)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">リンク</a>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ドロップダウン
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">メニュー1</a>
          <a class="dropdown-item" href="#">メニュー2</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">その他</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">無効</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input type="search" class="form-control mr-sm-2" placeholder="検索..." aria-label="検索...">
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">検索</button>
    </form>
  </div><!-- /.navbar-collapse -->
</nav>
  <header style="background-color:gray">Header</header>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2" style="background-color:red;">Red</div>
    <div class="col-sm-8 d-sm-none d-md-block" style="background-color:blue;">Blue</div>
    <div class="col-sm-2" style="background-color:yellow;">Yellow</div>
  </div>
</div>
<footer style="background-color:gray">Footer</footer>
<div class="dropdown drop-hover">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
    ドロップダウンボタン
  </button>
  <ul class="dropdown-menu">
    <li class="dropright drop-hover">
      <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">メニュー</a>
      <ul class="dropdown-menu">
        <li class="dropright drop-hover">
          <a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown">メニュー</a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="#">メニュー</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">メニュー</a>
            </li>
          </ul>
        </li>
        <li>
          <a class="dropdown-item" href="#">メニュー</a>
        </li>
        <li>
          <a class="dropdown-item" href="#">メニュー</a>
        </li>
      </ul>
    </li>
    <li>
      <a class="dropdown-item" href="#">メニュー</a>
    </li>
  </ul>
</div>
<style>
.drop-hover:hover > .dropdown-menu {
  display: block !important;
}
</style>

<style>
      th, td {
        white-space: nowrap;
      }
    
    </style>
<div class="table-responsive-sm">

  <table class="table" >
    <thead>
      <tr>
        <th>#</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>電話番号</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
          <td>煌木 太郎</td>
          <td>taro.kirameki@example.com</td>
          <td>09011112222</td>
      </tr>
      <tr>
        <th scope="row">2</th>
          <td>煌木 次郎</td>
          <td>jiro.kirameki@example.com</td>
          <td>09033334444</td>
      </tr>
      <tr>
        <th scope="row">3</th>
          <td>煌木 花子</td>
          <td>hanako.kirameki@example.com</td>
          <td>09055556666</td>
      </tr>
    </tbody>
  </table>
  </div>
  <button type="button" class="btn btn-default">Default</button>
<button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-success">Success</button>
<button type="button" class="btn btn-info">Info</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-link">Link</button>

<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
  </body>
</html>
<div class="dropdown ">
  <a class="btn btn-secondary 　dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown link
  </a>

  <div class="dropdown-menu　" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>


