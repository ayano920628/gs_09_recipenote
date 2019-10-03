<?php
session_start();
//1. POSTデータ取得
$userid   = $_POST["userid"];
$post  = $_POST["post"];

//2. DB接続します
include("../funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO post(userid,post,inputdate)VALUES(:userid,:post,sysdate())");
$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':post', $post, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error(); 

}else{
  redirect("select.php");
}
?>
