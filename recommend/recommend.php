<?php
session_start();
include("../funcs.php");
sschk();

$pdo = db_conn();
$sql = "SELECT * FROM recipe";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
} else {
  while($recipe = $stmt->fetch(PDO::FETCH_ASSOC)){
    $recipes[] .= $recipe[id];
  }
}

$keys = array_rand($recipes, 3);
shuffle($keys);
foreach($keys as $key){
    $recommend = $recipes[$key];
    $recipesql = "SELECT * FROM recipe WHERE id=:recipeid";
    $recipestmt = $pdo->prepare($recipesql);
    $recipestmt->bindValue(':recipeid', $recommend, PDO::PARAM_INT);
    $recipestatus = $recipestmt->execute();    
    //3. SQL実行時にエラーがある場合STOP
    if($recipestatus==false){
        sql_error();
    } else {
        $recommendrecipe = $recipestmt->fetch();
        $view .= '<div class="col-md-4"><h3>';
        $view .= $recommendrecipe["title"];
        $view .= '</h3><p>';
        $view .= $recommendrecipe["season"];
        $view .= '</p><p>';
        $view .= $recommendrecipe["ingredient1"].','.$recommendrecipe["ingredient2"].','.$recommendrecipe["ingredient3"];
        $view .= '</p>';
        $view .= '<p><a class="btn btn-secondary" href="../recipe/showrecipe.php?id='.$recommendrecipe["id"].'" role="button">View details &raquo;</a></p>';
        $view .= '</div>';
    }

}



if($_SESSION["kanri_flg"] == 1) {
  $viewusers = '<li class="nav-item active"><a class="nav-link" href="../users/users.php">Users</a></li>';
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
          <li class="nav-item active">
            <a class="nav-link" href="../signin/logout.php">Logout</a>
          </li>
          <?=$viewusers?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
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
        <h1 class="display-3">For <?=$_SESSION["name"]?></h1>
        <!-- <p></p>
        <p><a class="btn btn-primary btn-lg" href="../recommend/recommend.php" role="button">Recommendation &raquo;</a></p> -->
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
