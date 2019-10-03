<?php
session_start();
include("../funcs.php");

if(!isset($_SESSION['email'])){
    redirect("../user/login.php");
  } else {
    $pdo = db_conn();
    $email = $_SESSION['email'];
    $currentuser = $pdo->prepare("SELECT * FROM user WHERE email='$email'");
    $currentuserstatus = $currentuser->execute(); //実行
    if($currentuserstatus==false) {
      sql_error();
    }else{
        $userinfo = $currentuser->fetch();
        $loginuser = $userinfo["name"];
    }
  }
  
  $pdo = db_conn();

  //２．データ登録SQL作成
  $pageuser = $userinfo["id"];
  $post = $pdo->prepare("SELECT * FROM post WHERE userid='$pageuser'");
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
      $postview .= '<div class="post"><div class="firstline"><div class="postname">'.$username["name"].'</div>';
      $postview .= '</div>';
      $postview .= '<div class="posttext">'.$result["post"].'</div>';
      $postview .= '<div class="posttime">'.$result["inputdate"].'</div>';
      $postview .= '</div>';
    }
  }
  

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>マイページ</title>
<link rel="stylesheet" href="../css/range.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/common.css">

<!-- <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet"> -->
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href=""><?=$loginuser?>さんのページ</a>
            <a class="navbar-brand" href="../post/index.php">つぶやく</a>
            <a class="navbar-brand" href="../mypage/following.php">フォロー中</a>
            <a class="navbar-brand" href="../mypage/followed.php">フォロワー</a>
        </div>
        <div class="navbar-header">
            <a class="navbar-brand" href="../user/logout.php">ログアウト</a>
        </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <div> -->
    <!-- <div class="container jumbotron"><?=$allusers?></div> -->
<!-- </div> -->
<!-- Main[End] -->
<div>
    <div class="container jumbotron"><?=$postview?></div>
</div>


</body>
</html>
