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
$id     = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

//2.DB接続など
$pdo = db_conn();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
// 基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE user SET name=:name, email=:email, password=:password WHERE id=:id");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

if($status==false){
    sql_error();
}else{
  session_destroy();
  redirect("login.php");
}



?>
