<?php
 mb_internal_encoding("utf8");
 require "DB.php";

 if(empty($_POST['from_edit'])){
    header("Location:login_error.php");
}

$db=new DB();
$pdo = $db->connect();

//該当アカウントのチェック
$stmt = $pdo->prepare($db->delete());

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);

$stmt->execute();

//id番号のリセット＆Table整理
$organize_table =$pdo->prepare($db->organize());

$organize_table->execute();

$pdo = NULL;

//ログアウト処理
session_start();
session_destroy();

$alert = "<script type='text/javascript'>if (!alert('アカウントを削除しました。ログイン画面に戻ります。')) {
    location.href='login.php';
}</script>";
echo $alert;

?>