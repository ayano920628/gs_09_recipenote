<?php
session_set_cookie_params(60 * 5);
session_start();

//1. POSTデータ取得
$email  = $_POST["email"];
$password = $_POST["password"];

//2. DB接続します
include("../funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM user WHERE email='$email' AND password='$password'");
$status = $stmt->execute(); //実行



// ４．データ登録処理後
// $view="";
if($status==false) {
  sql_error();
}else{
    $r = $stmt->fetch();
    if($r == false){
        echo "EmailかPasswordが正しくありません";
    } else {
        if(!isset($_SESSION['email'])){
            $_SESSION['email'] = $email;
            echo "ログインしました";
        } else {
            echo "ログイン済みです";
        }
        redirect('../post/index.php');
    }
}
?>
