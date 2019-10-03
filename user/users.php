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

function checkfollow($loginuser, $followed){
  $pdo = db_conn();
  $relationship = $pdo->prepare("SELECT * FROM relationship WHERE followinguser='$loginuser'");
  $relationshipstatus = $relationship->execute(); //実行
  if($relationshipstatus==false){
    sql_error();
  } else {
    while ( $relationresult = $relationship->fetch(PDO::FETCH_ASSOC)) {
      if($relationresult["followeduser"]==$followed){
        return '<div class="btn btn-success" id="following">フォロー中</div>';
      } else {
        return '<div class="btn btn-success" id="notfollow">フォローする</div>';
      }
    }
  }
};

function follow($loginuser, $followed){
  $pdo = db_conn();
  $life = 1;
  $stmt = $pdo->prepare("INSERT INTO relationship(followinguser,followeduser,life,inputdate)VALUES(:followinguser,:followeduser,:life,sysdate())");
  $stmt->bindValue(':followinguser', $loginuser, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':followeduser', $followed, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':lifeflg', $life, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $status = $stmt->execute(); //実行    

};

$pdo = db_conn();
$allusers = "";
$users = $pdo->prepare("SELECT * FROM user");
$usersstatus = $users->execute(); //実行
if($usersstatus==false) {
  sql_error();
}else{
    while( $result = $users->fetch(PDO::FETCH_ASSOC)){
        $userid = $result["id"];
        $user = $pdo->prepare("SELECT * FROM user WHERE id='$userid'");
        $userstatus = $user->execute(); //実行    
        if($userstatus==false) {
            sql_error();
        }else{
            $username = $user->fetch();
        }
        $allusers .= '<div class="firstline"><a href="../mypage/userpage.php?id='.$result["id"].'">'.$result["name"];
        $allusers .= '</a><div>';
        $allusers .= checkfollow($userinfo["id"],$userid);
        $allusers .= '</div>';
        if($username["id"] == $userinfo["id"]){
            $allusers .= '<div class="editdelete"><a href="detail.php?id='.$result["id"].'"><i class="fas fa-edit"></i></a>';
            $allusers .= '<a href="delete.php?id='.$result["id"].'"><i class="fas fa-trash-alt"></i></a></div>';
        }
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
<title>つぶやき表示</title>
<script src="../js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="../css/range.css">
<link rel="stylesheet" href="../css/common.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
        <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$allusers?></div>
</div>
<!-- Main[End] -->

<script>
  // $("#notfollow").on("click", function(){
  //   let value1 = 1;
  //   let value2 = 2;
  //   $.ajax({
  //     type: 'post',
  //     url: 'test.php',
  //     data: {value : value1},
  //     success: function(output){
  //     //非同期通信に成功したときの処理
  //     console.log(output);
  //     }
  //   });
  // });

</script>


</body>
</html>
