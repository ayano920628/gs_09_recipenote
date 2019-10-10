<?php
session_start();
include("../funcs.php");
sschk();


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Recipe</title>
      <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/4.0/examples/starter-template/starter-template.css" rel="stylesheet">
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

    <div class="container">
      <form action="../recipe/createrecipe.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Recipe</h1>
        <label for="" class="sr-only">Recipe title</label>
        <input type="text" name="title" class="form-control" placeholder="Recipe title" required autofocus>
        <label for="" class="sr-only">Ingredient</label>
        <input type="text" name="ingredient1" class="form-control" placeholder="Ingredient" required autofocus>
        <label for="" class="sr-only">Ingredient</label>
        <input type="text" name="ingredient2" class="form-control" placeholder="Ingredient">
        <label for="" class="sr-only">Ingredient</label>
        <input type="text" name="ingredient3" class="form-control" placeholder="Ingredient">
        <label for="" class="sr-only">Memo</label>
        <textarea type="text" name="recipememo" class="form-control" placeholder="Recipe Memo"></textarea>
        <label for="" class="sr-only">URL</label>
        <input type="text" name="url" class="form-control" placeholder="URL">
        <label for="" class="sr-only">Season</label>
        <select name="season" id="" class="form-control" placeholder="Season">
          <option value="all">All</option>
          <option value="spring">Spring</option>
          <option value="summer">Summer</option>
          <option value="autumn">Autumn</option>
          <option value="winter">Winter</option>
        </select>
        <label for="" class="sr-only">Review</label>
        <textarea name="review" id="" class="form-control" placeholder="Review"></textarea>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
      </form>

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>
