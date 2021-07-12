<?php
mb_internal_encoding("utf8");
require "DB.php";
session_start();

if(empty($_SESSION['id'])){
    $db=new DB();
    try {
        $pdo=$db->connect();
    } catch(PDOException $e) {
        die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>");
    }
//prepared statementでSQL文の型を作る
$stmt = $pdo->prepare($db->select2());

//bindValueメソッドでパラメーターをセット
$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);

//executeでクエリを実行
$stmt->execute();

//DBを切断
$pdo = NULL;

//fetch.while文でデータを取得し、sessionに代入
while($row = $stmt->fetch()){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}

//sessionがなければエラー画面へ
if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }

  //「ログイン状態を保持する」にチェックが入っていた場合、postされたlogin_keepの値をsessionに保存する。
if (!empty($_POST['login_keep'])){
    $_SESSION['login_leep']=$_POST['login_keep'];
    }
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'], time()+60*60*24*7);
    setcookie('password',$_SESSION['password'], time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'], time()+60*60*24*7);
} else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css" />
    <script src="logout_confirm.js"></script>
</head>
<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <a href="javascript:void(0);" class="logout" onclick="confirmLogout()">ログアウト</a>
    </header>

    <main>
            <div class="form_contents">
                <h2>会員情報</h2>
                <p><?php echo "こんにちは！ ".$_SESSION['name']."さん"; ?></p>
                <div class="profile">
                   <dvi class="profile_left">
                       <img src="./image/<?php echo $_SESSION['picture']; ?>" width="180" height="180">
                   </dvi>
                   <div class="profile_right">
                       <div class="name">
                       <p>氏名 : <?php echo $_SESSION['name']; ?></p>
                       </div>
                       <div class="mail">
                       <p>メールアドレス : <?php echo $_SESSION['mail']; ?></p>
                       </div>
                       <div class="password">
                       <p>パスワード : <?php echo $_SESSION['password']; ?></p>
                       </div>
                   </div>
                </div>
                <div class="profile_bottom">
                   <div class="comments">
                       <p><?php echo $_SESSION['comments']; ?></p>
                   </div>

                   <form action="mypage_hensyu.php" method="post" class="form_center">
                   <!-- 乱数飛ばす -->
                       <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
                       <input type="submit" class="submit_button1" size="35" value="編集する">
                   </form>
               </div>
    </main>

    <footer>
        ©︎ 2018 InterNous.inc. All rights reserved
    </footer>   
</body>
</html>