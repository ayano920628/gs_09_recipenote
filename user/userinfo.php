<?php
session_start();

//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$password = $_POST["password"];
$administrator   = $_POST["administrator"];
$lifeflg   = $_POST["lifeflg"];

//2. DB接続します
include("../funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO user(name,email,password,administrator,lifeflg,inputdate)VALUES(:name,:email,:password,:administrator,:lifeflg,sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':administrator', $administrator, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lifeflg', $lifeflg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  $_SESSION['email'] = $email;
  redirect('../post/index.php');
}
?>
