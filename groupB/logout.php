<?php
session_start();
 
// セッション変数をすべて解除
$_SESSION = array();
 
// クッキーに保存されているセッションIDも削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 
// セッションを破棄
session_destroy();
 
// ★★★ 修正: リダイレクト先をログイン画面に変更 ★★★
header('Location: ログイン画面.php');
exit();
?>