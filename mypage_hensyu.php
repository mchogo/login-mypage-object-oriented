<?php
mb_internal_encoding("utf8");
session_start();

//mypage.phpからの導線以外は「login_error.phpへリダイレクト」
if(empty($_POST['from_mypage'])){
    header("Location:login_error.php");
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage_hensyu.css" />
    <!-- 確認ダイアログ用スクリプト -->
    <script type="text/javascript" src = "edit_confirm.js"></script>
    <script type="text/javascript" src="logout_confirm.js"></script>
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

            <form action="mypage_update.php" method="post" onSubmit="return change_confirm()">
                <div class="profile">
                    <dvi class="profile_left">
                        <img src="./image/<?php echo $_SESSION['picture']; ?>" width="180" height="180">
                    </dvi>
                    <div class="profile_right">
                        <div class="name">
                            <label>氏名 : <input class="formbox" type="text" size="40" name="name" value="<?php echo $_SESSION['name']; ?>" required></label>
                        </div>
                        <div class="mail">
                            <label>メールアドレス : <input class="formbox" type="text" size="40" name="mail" value="<?php echo $_SESSION['mail']; ?>" pattern="^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$" required></label>
                        </div>
                        <div class="password">
                            <label>パスワード : <input class="formbox" type="text" size="40" name="password" value="<?php echo $_SESSION['password']; ?>" pattern="^[a-zA-Z0-9]{6,}$" required></label>
                        </div>
                   </div>
                </div>
                <div class="profile_bottom">
                    <div class="comments">
                        <label><textarea class="formbox" name="comments" cols="45" rows="4" value=""><?php echo $_SESSION['comments']; ?></textarea></label>
                    </div>
                        <input type="submit" class="submit_button1" size="35" value="登録内容を変更する";>
               </div>
            </form>
            <form action="delete_account.php" method="post" onSubmit="return delete_confirm()">
                <input type="hidden" value="<?php echo rand(1,10);?>" name="from_edit">
                <input type="submit" class="submit_button2" size="35" value="アカウントを削除する">
                <div class="profile_hidden">
                       <div class="name">
                       <input type="text" value="<?php echo $_SESSION['name']?>" name="name">
                       </div>
                       <div class="mail">
                       <input type="text" value="<?php echo $_SESSION['mail']?>" name="mail">
                       </div>
                       <div class="password">
                       <input type="text" value="<?php echo $_SESSION['password']?>" name="password">
                       </div>
                   </div>
            </form>
            
        </div>
    </main>

    <footer>
        ©︎ 2018 InterNous.inc.All rights reserved
    </footer>

    
</body>
</html>