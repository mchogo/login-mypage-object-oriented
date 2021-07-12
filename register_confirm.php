<?php mb_internal_encoding("utf8");

$temp_pick_name = $_FILES['picture']['tmp_name'];

$original_pic_name = $_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;

move_uploaded_file($temp_pick_name,'./image/'.$original_pic_name);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="register_confirm.css" />
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>

        <main>
        <form action="register.php" method="post">
            <div class="form_contents">
                <h2>会員登録 確認</h2>
                <p class="">登録する内容を確認してください。</p>
                <div class="name">
                <label>氏名 : <?php echo $_POST['name']?></label>
                </div>
                <div class="mail">
                <label>メールアドレス : <?php echo $_POST['mail']?></label>
                </div>
                <div class="password">
                <label>パスワード : <?php echo $_POST['password']?></label>
                </div>
                <div class="picture">
                <label>プロフィール写真 : <?php echo $original_pic_name = $_FILES['picture']['name']; ?></label>
                </div>
                <div class="comments">
                <label>コメント : <?php echo $_POST['comments']?></label>
                </div>
                </form>
                <div class="toroku">
                    <form action="register.php" method="post">
                    <!-- 戻って修正の場合は氏名とメールアドレスだけ送り返す。 -->
                        <input type="submit" class="submit_button1" size="35" value="戻って修正する">
                        <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                        <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                    </form>
                    <form action="register_insert.php" method="post">
                    <!-- 登録ボタンの場合は全部送る -->
                        <input type="submit" class="submit_button2" size="35" value="登録する">
                        <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                        <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                        <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                        <input type="hidden" value="<?php echo $original_pic_name = $_FILES['picture']['name']; ?>" name="path_filename">
                        <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                    </form>
                </div>
            </div>
        </main>

        <footer>
            ©︎ 2018 InterNous.inc. All rights reserved
        </footer>

    
    </body>
</html>