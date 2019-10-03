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
$post = $_POST["post"];
$userid = $_POST["userid"];

//2.DB接続など
$pdo = db_conn();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$stmt = $pdo->prepare("UPDATE post SET userid=:userid, post=:post WHERE id=:id");
$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':post', $post, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

if($status==false){
    sql_error();
}else{
    redirect("select.php");
}



?>
