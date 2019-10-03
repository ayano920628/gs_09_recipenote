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

//1.POSTでParamを取得
$id     = $_GET["id"];

//2.DB接続など
$pdo = db_conn();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
// 基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("DELETE FROM user WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

$stmt2 = $pdo->prepare("DELETE FROM relationship WHERE followinguser=:id OR followeduser=:id");
$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$status2 = $stmt2->execute(); //実行

$stmt3 = $pdo->prepare("DELETE FROM post WHERE userid=:id");
$stmt3->bindValue(':id', $id, PDO::PARAM_INT);
$status3 = $stmt3->execute(); //実行

if($status==false || $status2==false || $status3==false){
    sql_error();
}else{
    session_destroy();
    redirect("login.php");
}



?>
