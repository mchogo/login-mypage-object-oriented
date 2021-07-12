function confirmLogout(){
	        if(window.confirm('ログアウトしてよろしいですか？')){ // ログアウト時確認ダイアログを表示
                alert ("ログアウトしました。");
                location.href="log_out.php"
	        } else{ // 「キャンセル」時の処理
		        return false; // 処理を中止
	        }
        }