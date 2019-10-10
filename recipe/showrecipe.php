<?php
session_start();
include("../funcs.php");
// sschk();
$recipeid = $_GET["id"];

$pdo = db_conn();
$sql = "SELECT * FROM recipe WHERE id=:recipeid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':recipeid', $recipeid, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
    sql_error();
} else {
    $recipe = $stmt->fetch();
}
if($recipe["userid"] != $_SESSION["id"]){
    $view = '<a href="copyrecipe.php?id='.$recipeid.'"><i class="far fa-copy"></i></a>';
}
if($recipe["userid"] == $_SESSION["id"] || $_SESSION["kanri_flg"] == 1){
    $view .= '<a href="detail.php?id='.$recipeid.'"><i class="fas fa-edit"></i></i></a>';
    $view .= '<a href="delete.php?id='.$recipeid.'"><i class="fas fa-trash-alt"></i></a>';
}

$usersql = "SELECT * FROM users WHERE id=:userid";
$userstmt = $pdo->prepare($usersql);
$userstmt->bindValue(':userid', $recipe["userid"], PDO::PARAM_STR);
$userstatus = $userstmt->execute();

if($userstatus==false){
  sql_error();
} else {
  $userresult = $userstmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recipe</title>
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/4.0/examples/starter-template/starter-template.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
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

    <div class="container">
        <h5><a href="../mypage/userpage.php?id=<?=$userresult["id"]?>"><?=$userresult["name"]?></a>さんの</h5>
        <h1 class="h3 mb-3 font-weight-normal"><?=$recipe["title"]?></h1>
        <p><?=$view?></p>
        <h4>Season</h4>
        <label for="" class="sr-only">Season</label>
        <div name="season" class="form-control"><?=$recipe["season"]?></div>
        <h4>Ingredients</h4>
        <label for="" class="sr-only">Recipe title</label>
        <div name="ingredient" class="form-control"><?=$recipe["ingredient1"].', '.$recipe["ingredient2"].', '.$recipe["ingredient3"]?></div>
        <h4>URL</h4>
        <label for="" class="sr-only">URL</label>
        <div name="url" class="form-control"><a href="<?=$recipe["url"]?>"><?=$recipe["url"]?></a></div>
        <h4>Recipe Memo</h4>
        <label for="" class="sr-only">Recipe Memo</label>
        <div name="recipememo" class="form-control"><?=$recipe["recipememo"]?></div>
        <h4>Review</h4>
        <label for="" class="sr-only">Review</label>
        <div name="review" class="form-control"><?=$recipe["review"]?></div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>

      <!-- <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div> -->

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>
