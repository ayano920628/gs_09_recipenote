<?php
session_start();
include("../funcs.php");
sschk();
$recipeid = $_GET["id"];

//1. POSTデータ取得

//2. DB接続します
$pdo = db_conn();

// ３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE recipe SET userid=:userid,title=:title,ingredient1=:ingredient1,ingredient2=:ingredient2,ingredient3=:ingredient3,url=:url,recipememo=:recipememo,season=:season,review=:review,original=:original,author=:author,WHERE id=:id");
$stmt->bindValue(':id', $recipeid, PDO::PARAM_INT);
$stmt->bindValue(':userid', $_SESSION["id"], PDO::PARAM_INT);
$stmt->bindValue(':title', $_POST["title"], PDO::PARAM_STR);
$stmt->bindValue(':ingredient1', $_POST["ingredient1"], PDO::PARAM_STR);
$stmt->bindValue(':ingredient2', $_POST["ingredient2"], PDO::PARAM_STR);
$stmt->bindValue(':ingredient3', $_POST["ingredient3"], PDO::PARAM_STR);
$stmt->bindValue(':url', $_POST["url"], PDO::PARAM_STR);
$stmt->bindValue(':recipememo', $_POST["recipememo"], PDO::PARAM_STR);
$stmt->bindValue(':season', $_POST["season"], PDO::PARAM_STR);
$stmt->bindValue(':review', $_POST["review"], PDO::PARAM_STR);
$stmt->bindValue(':original', $_SESSION["id"], PDO::PARAM_INT);
$stmt->bindValue(':author', $_SESSION["id"], PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error();
}else{
    redirect("../mypage/index.php");
}


?>
