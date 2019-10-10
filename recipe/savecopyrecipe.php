<?php
session_start();
include("../funcs.php");
sschk();

//1. POSTデータ取得

//2. DB接続します
$pdo = db_conn();

// ３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO recipe(userid,title,ingredient1,ingredient2,ingredient3,url,recipememo,season,review,original,author,inputdate)VALUES(:userid,:title,:ingredient1,:ingredient2,:ingredient3,:url,:recipememo,:season,:review,1,:author,sysdate())");
$stmt->bindValue(':userid', $_SESSION["id"], PDO::PARAM_INT);
$stmt->bindValue(':title', $_POST["title"], PDO::PARAM_STR);
$stmt->bindValue(':ingredient1', $_POST["ingredient1"], PDO::PARAM_STR);
$stmt->bindValue(':ingredient2', $_POST["ingredient2"], PDO::PARAM_STR);
$stmt->bindValue(':ingredient3', $_POST["ingredient3"], PDO::PARAM_STR);
$stmt->bindValue(':url', $_POST["url"], PDO::PARAM_STR);
$stmt->bindValue(':recipememo', $_POST["recipememo"], PDO::PARAM_STR);
$stmt->bindValue(':season', $_POST["season"], PDO::PARAM_STR);
$stmt->bindValue(':review', $_POST["review"], PDO::PARAM_STR);
$stmt->bindValue(':author', $_POST["author"], PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error();
}else{
    redirect("../mypage/index.php");
}


?>
