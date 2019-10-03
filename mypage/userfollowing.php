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
$allusers = "";
$id = $_GET["id"];
$pageuser = $pdo->prepare("SELECT * FROM user WHERE id='$id'");
$pageuserstatus = $pageuser->execute(); //実行
if($pageuserstatus==false) {
    sql_error();
}else{
    $pageusername = $pageuser->fetch();    
}

$users = $pdo->prepare("SELECT * FROM relationship WHERE followinguser='$id'");
$usersstatus = $users->execute(); //実行
if($usersstatus==false) {
    sql_error();
}else{
    while( $result = $users->fetch(PDO::FETCH_ASSOC)){
        $followedid = $result["followeduser"];
        $user = $pdo->prepare("SELECT * FROM user WHERE id='$followedid'");
        $userstatus = $user->execute(); //実行    
        if($userstatus==false) {
            sql_error();
        }else{
            $username = $user->fetch();
        }
        $allusers .= '</a><div>';
        $allusers .= '</div>';
        $allusers .= '</div>';
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
            <a class="navbar-brand" href="../mypage/userpage.php?id=<?=$id?>"><?=$pageusername["name"]?>さんのページ</a>
            <a class="navbar-brand" href="../mypage/userfollowed.php?id=<?=$id?>">フォロワー</a>
        </div>
        <!-- <div class="navbar-header">
            <a class="navbar-brand" href="../user/logout.php">ログアウト</a>
        </div> -->
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <div> -->
    <!-- <div class="container jumbotron"></div> -->
<!-- </div> -->
<!-- Main[End] -->
<div>
    <div class="container jumbotron"><?=$allusers?></div>
</div>


</body>
</html>
