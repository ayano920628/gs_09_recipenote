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


$pdo = db_conn();

//２．データ登録SQL作成
$post = $pdo->prepare("SELECT * FROM post");
$poststatus = $post->execute();

//３．データ表示
$postview="";
if($poststatus==false) {
  sql_error();
}else{
  while( $result = $post->fetch(PDO::FETCH_ASSOC)){
    $userid = $result["userid"];
    $postuser = $pdo->prepare("SELECT * FROM user WHERE id='$userid'");
    $postuserstatus = $postuser->execute(); //実行
    if($postuserstatus==false) {
      sql_error();
    }else{
      $username = $postuser->fetch();
    }
    $id = $userinfo["id"];
    $relationship = $pdo->prepare("SELECT * FROM relationship where followinguser='$id'");
    $relationshipstatus = $relationship->execute(); //実行
    if($relationshipstatus==false) {
      sql_error();
    }else{
      while($following = $relationship->fetch(PDO::FETCH_ASSOC)){
        $followinguser[] .= $following["followeduser"];
      }
    }
    if($userinfo["id"] == $username["id"] || in_array($username["id"],$followinguser)){
      $postview .= '<div class="post"><div class="firstline"><div class="postname">'.$username["name"].'</div>';
      if($userinfo["id"] == $username["id"]){
        $postview .= '<div class="editdelete"><a href="detail.php?id='.$result["id"].'"><i class="fas fa-edit"></i></a>';
        $postview .= '<a href="delete.php?id='.$result["id"].'"><i class="fas fa-trash-alt"></i></a></div>';
      }
      $postview .= '</div>';
      $postview .= '<div class="posttext">'.$result["post"].'</div>';
      $postview .= '<div class="posttime">'.$result["inputdate"].'</div>';
      $postview .= '</div>';  
    }
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>つぶやき表示</title>
<link rel="stylesheet" href="../css/range.css">
<link rel="stylesheet" href="../css/common.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../post/index.php">つぶやく</a>
        <a class="navbar-brand" href="../post/select.php">つぶやき</a>
      </div>
      <div class="navbar-header">
        <a class="navbar-brand" href="../mypage/mypage.php">ログイン：<?=$loginuser?></a>
        <a class="navbar-brand" href="../user/logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$postview?></div>
</div>
<!-- Main[End] -->

</body>
</html>
