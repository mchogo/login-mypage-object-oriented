function delete_confirm(){
    if(window.confirm('アカウントを削除してよろしいですか？(この操作は取り消せません。)')){ // アカウント削除時確認ダイアログを表示
        return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
        window.alert('キャンセルされました'); // 警告ダイアログを表示
        return false; // 送信を中止
    }
}
function change_confirm(){
    if(window.confirm('登録情報を変更してよろしいですか？')){ // 登録情報変更時確認ダイアログを表示
        window.alert('登録情報を変更しました。');
        return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
        return false; // 送信を中止
    }
}