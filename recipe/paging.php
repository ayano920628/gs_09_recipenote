<?php

include("../funcs.php");

$pdo = db_conn();
$countsql = "SELECT COUNT(*) FROM recipe WHERE original=0";
$count = $pdo->prepare($countsql);
$countstatus = $count->execute();

if($countstatus==false){
    sql_error();
} else {
    $r = $count->fetch();
    $count = $r[0];
}

$sql = "SELECT * FROM recipe WHERE original=0";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
} else {
  while($recipe = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view = '<div class="col-md-4"><h3>';
      $view .= $recipe["title"];
      $view .= '</h3><p>';
      $view .= $recipe["season"];
      $view .= '</p><p>';
      $view .= $recipe["ingredient1"].','.$recipe["ingredient2"].','.$recipe["ingredient3"];
      $view .= '</p>';
      $view .= '<p><a class="btn btn-secondary" href="../recipe/showrecipe.php?id='.$recipe["id"].'" role="button">View details &raquo;</a></p>';
      $view .= '</div>';
    $recipetitle[] .= $view;
}
}

define('MAX','3'); // 1ページの記事の表示数
 
$max_page = ceil($count / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
 
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
 
$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
 
// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($recipetitle, $start_no, MAX, true);
 
foreach($disp_data as $val){ // データ表示
    // echo $val['book_kind']. '　'.$val['book_name']. '<br />';
    echo $val.'<br />';

}

if($now > 1){ // リンクをつけるかの判定
    echo '<a href=\'../recipe/paging.php?page_id='.($now - 1).'\')>前へ</a>'. '　';
} else {
    echo '前へ'. '　';
}
for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
        echo $now. '　'; 
    } else {
        echo '<a href=\'../recipe/paging.php?page_id='. $i. '\')>'. $i. '</a>'. '　';
    }
}
if($now < $max_page){ // リンクをつけるかの判定
    echo '<a href=\'../recipe/paging.php?page_id='.($now + 1).'\')>次へ</a>'. '　';
} else {
    echo '次へ';
}

?>