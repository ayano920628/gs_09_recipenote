<?php
session_start();
//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$pw = $_POST["password"];
$password = password_hash($pw, PASSWORD_DEFAULT);


//2. DB接続します
include("../funcs.php");
$pdo = db_conn();

// emailの重複確認
$emailcheck = $pdo->prepare("SELECT * FROM users WHERE email=:email");
$emailcheck->bindValue(':email', $email, PDO::PARAM_STR);
$checkstatus = $emailcheck->execute();
$link = "";
if($checkstatus == false) {
  sql_error();
} else {
  $val = $emailcheck->fetch();
  if($val) {
    if($val["lifeflg"] == 0) {
      $link .= "既にアカウントがあります";
      $link .= '<a href="../signin/signin.php">ログインはこちらから</a>';
    } else {
      $stmt = $pdo->prepare("UPDATE users SET name=:name, password=:password, lifeflg=0, kanriflg=0 WHERE email=:email");
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
      $status = $stmt->execute(); //実行
  
      //４．データ登録処理後
      if($status==false){
        sql_error();
      }else{
        $_SESSION["chk_ssid"]  = session_id();
        $_SESSION["kanri_flg"] = $val['kanriflg'];
        $_SESSION["name"]      = $val['name'];
        $_SESSION["id"]        = $val['id'];   
        redirect("../mypage/index.php");
      }  
    }
  } else {
    // ３．データ登録SQL作成
    $stmt = $pdo->prepare("INSERT INTO users(name,email,password,lifeflg, kanriflg)VALUES(:name,:email,:password,0,0)");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute(); //実行

    //４．データ登録処理後
    if($status==false){
      sql_error();
    }else{
      $_SESSION["chk_ssid"]  = session_id();
      $_SESSION["kanri_flg"] = 0;
      $_SESSION["name"]      = $name;
      $user = $pdo->prepare("SELECT * FROM users WHERE email=:email");
      $user->bindValue(':email', $email, PDO::PARAM_STR);
      $userstatus = $user->execute();
      $val = $user->fetch();
      $_SESSION["id"]        = $val["id"];
      redirect("../mypage/index.php");
    }

  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <p><?=$link?></p>
</body>
</html>