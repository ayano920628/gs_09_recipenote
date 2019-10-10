<?php
session_start();
include("../funcs.php");
sschk();

//1. POSTデータ取得
$userid = $_GET["id"];

if(($_SESSION["id"]) == $userid || $_SESSION["kanri_flg"] == 1){
  //2. DB接続します
  $pdo = db_conn();

  //３．データ登録SQL作成
  $stmt = $pdo->prepare("UPDATE users SET lifeflg=1 WHERE id=:userid");
  $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
  $status = $stmt->execute(); //実行

  //４．データ登録処理後
  if($status==false){
    sql_error();
  }else{
    if($_SESSION["kanri_flg"] == 1){
      redirect("../users/users.php");
    } else {
      $_SESSION = array();
      //Cookieに保存してある"SessionIDの保存期間を過去にして破棄
      if (isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
          setcookie(session_name(), '', time()-42000, '/');
      }
      //サーバ側での、セッションIDの破棄
      session_destroy();
      redirect("../signup/signup.php");
    }
  }
  
} else {
  exit("LOGIN ERROR");
}

?>
