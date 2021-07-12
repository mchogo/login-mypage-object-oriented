<?php
mb_internal_encoding("uft8");

//セッションスタート
session_start();

//DB接続・try catch文
require "DB.php";
$db=new DB();
try {
    $pdo=$db->connect();
} catch(PDOException $e) {
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>");
}


//preparedステートメント(Update)でSQLをセット //bindValueでパラメーターをセットする
$stmt = $pdo->prepare($db->update());
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);
//executeでクエリの実行
$stmt->execute();

//preparedステートメント(更新されたDBをselect)でSQLをセット //bindValueでパラメーターをセットする
$stmt = $pdo->prepare($db->select1());
$stmt->bindValue(1,$_SESSION['id']);
//クエリの実行
$stmt->execute();

//DBの切断
$pdo = NULL;

//fetch・while文でデータ取得し、セッションに代入
while($row = $stmt->fetch()){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}

header('Location:mypage.php');

?>