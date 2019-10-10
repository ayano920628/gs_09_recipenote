<?php
session_start();
include("../funcs.php");

$pdo = db_conn();

$countsql = "SELECT COUNT(*) FROM recipe WHERE original=0";
$count = $pdo->prepare($countsql);
$countstatus = $count->execute();

if($countstatus==false){
    sql_error();
} else {
    $r = $count->fetch();
    $count = $r[0];
}

$sql = "SELECT * FROM recipe WHERE original=0";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
} else {
  while($recipe = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view = '<div class="col-md-4"><h3>';
      $view .= $recipe["title"];
      $view .= '</h3><p>';
      $view .= $recipe["season"];
      $view .= '</p><p>';
      $view .= $recipe["ingredient1"].','.$recipe["ingredient2"].','.$recipe["ingredient3"];
      $view .= '</p>';
      $view .= '<p><a class="btn btn-secondary" href="../recipe/showrecipe.php?id='.$recipe["id"].'" role="button">View details &raquo;</a></p>';
      $view .= '</div>';
    $recipetitle[] .= $view;
}
}

define('MAX','6'); // 1ページの記事の表示数
 
$max_page = ceil($count / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
 
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
 
$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
 
// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($recipetitle, $start_no, MAX, true);
 
foreach($disp_data as $val){ // データ表示
    // echo $val['book_kind']. '　'.$val['book_name']. '<br />';
    $showrecipe .= $val.'<br />';

}

if($now > 1){ // リンクをつけるかの判定
    $paging .= '<a href=\'../recipe/allrecipe.php?page_id='.($now - 1).'\')>前へ</a>'. '　';
} else {
    $paging .= '前へ'. '　';
}
for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
      $paging .= $now. '　'; 
    } else {
      $paging .= '<a href=\'../recipe/allrecipe.php?page_id='. $i. '\')>'. $i. '</a>'. '　';
    }
}
if($now < $max_page){ // リンクをつけるかの判定
  $paging .= '<a href=\'../recipe/allrecipe.php?page_id='.($now + 1).'\')>次へ</a>'. '　';
} else {
  $paging .= '次へ';
}
if($_SESSION["kanri_flg"] == 1) {
  $viewusers = '<li class="nav-item active"><a class="nav-link" href="../users/users.php">Users</a></li>';
  $viewusers .= '<li class="nav-item active"><a class="nav-link" href="../recipe/recipeforadmin.php">Recipe</a></li>';
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recipe Note</title>

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/jumbotron/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="../recipe/allrecipe.php">All Recipe</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../mypage/index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../recipe/recipe.php">Add Recipe</a>
          </li>
          <?=$viewusers?>
          <li class="nav-item active">
            <a class="nav-link" href="../signin/logout.php">Logout</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="../mypage/delete.php?id=<?=$_SESSION["id"]?>">Resign</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="../recipe/search.php">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">All Recipe</h1>
        <p></p>
        <p><a class="btn btn-primary btn-lg" href="../recommend/recommend.php" role="button">Recommendation &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?=$showrecipe?>
      </div>
      <div class="text-center">
      <?=$paging?>
      </div>

      <hr>
      <footer>
        <p>&copy; Company 2017</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  </body>
</html>

