<?php
session_start();
include("../funcs.php");
sschk();
$userid = $_GET["id"];

//1. POSTデータ取得

//2. DB接続します
$pdo = db_conn();

// ３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE users SET name=:name,email=:email,lifeflg=:lifeflg,kanriflg=:kanriflg WHERE id=:userid");
$stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
$stmt->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
$stmt->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
$stmt->bindValue(':lifeflg', $_POST["lifeflg"], PDO::PARAM_INT);
$stmt->bindValue(':kanriflg', $_POST["kanriflg"], PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error();
}else{
    redirect("../users/users.php");
}


?>
