<?php
session_start();
include("../funcs.php");

if(!isset($_SESSION['email'])){
  redirect("../user/login.php");
} else {
  $pdo = db_conn();
  $email = $_SESSION['email'];
  $user = $pdo->prepare("SELECT * FROM user WHERE email='$email'");
  $userstatus = $user->execute(); //実行
  if($userstatus==false) {
    sql_error();
  }else{
      $userinfo = $user->fetch();
      $loginuser = $userinfo["name"];
  }
}

// <a>でurlのid=以降を取得している
$id = $_GET["id"];

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM post where id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
// $view="";
if($status==false) {
  sql_error();
}else{
    $row = $stmt->fetch();
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <a class="navbar-brand" href="#"><?=$loginuser?></a>
    <a class="navbar-brand" href="../user/logout.php">ログアウト</a>

    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>[編集]</legend>
     <label><textArea name="post" rows="4" cols="40"><?=$row["post"]?></textArea></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="hidden" name="userid" value="<?=$row["userid"]?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
