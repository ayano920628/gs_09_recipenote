<?php
session_start();
include("../funcs.php");
// sschk();

if(!isset($_SESSION["kanri_flg"]) || $_SESSION["kanri_flg"] != 1){
  exit("LOGIN ERROR");
} else {
  session_regenerate_id(true);
  $_SESSION["chk_ssid"] = session_id();
}


$pdo = db_conn();
$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
} else {
  $view = '<table><tr><th>id</th><th>name</th><th>email</th><th>lifeflg</th><th>kanriflg</th><th>edit/delete</th></tr>'; 
  while($user = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>'.$user["id"].'</td>';
    $view .= '<td><a href="../mypage/userpage.php?id='.$user["id"].'">'.$user["name"].'</a></td>';
    $view .= '<td>'.$user["email"].'</td>';
    $view .= '<td>'.$user["lifeflg"].'</td>';
    $view .= '<td>'.$user["kanriflg"].'</td>';
    $view .= '<td>';
    $view .= '<a href="../mypage/detail.php?id='.$user["id"].'"><i class="fas fa-edit"></i></i></a>';
    $view .= '<a href="../mypage/delete.php?id='.$user["id"].'"><i class="fas fa-trash-alt"></i></a>';
    $view .= '</td>';
    $view .= '</tr>';
  }
  $view .= '</table>'; 
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

    <title>Users</title>

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/jumbotron/jumbotron.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

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
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Users</h1>
        <!-- <p></p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?=$view?>
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

