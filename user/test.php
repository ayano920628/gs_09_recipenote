<?php
// session_start();
// include("../funcs.php");

// if(!isset($_SESSION['email'])){
//   redirect("../user/login.php");
// } else {
//   $pdo = db_conn();
//   $email = $_SESSION['email'];
//   $currentuser = $pdo->prepare("SELECT * FROM user WHERE email='$email'");
//   $currentuserstatus = $currentuser->execute(); //実行
//   if($currentuserstatus==false) {
//     sql_error();
//   }else{
//       $userinfo = $currentuser->fetch();
//       $loginuser = $userinfo["name"];
//   }
// }

// $pdo = db_conn();
// $life = 1;
// $stmt = $pdo->prepare("INSERT INTO relationship(followinguser,followeduser,life,inputdate)VALUES(:followinguser,:followeduser,:life,sysdate())");
// $stmt->bindValue(':followinguser', $loginuser, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':followeduser', $followed, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':lifeflg', $life, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $status = $stmt->execute(); //実行    

$value1 = value;
echo $value1;

?>