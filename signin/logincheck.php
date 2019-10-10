<?php
session_start();
include("../funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
$sql = "SELECT * FROM users WHERE email=:email AND lifeflg=0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if( password_verify($_POST["password"], $val["password"]) ){
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanriflg'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["id"]      = $val['id'];
  redirect("../mypage/index.php");
}else{
  //Login失敗時(Logout経由)
  redirect("../signin/signin.php");
}

exit();

?>