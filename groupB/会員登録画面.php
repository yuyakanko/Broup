<?php 
session_start(); 
require 'データベース.php'; // データベース接続設定の読み込み

$email = $pass = $name = $zipcode = '';
$error_message = '';

// 1. エラーリダイレクト時の一時セッション情報（customer_temp）をチェック
if (isset($_SESSION['customer_temp'])) {
    $email = $_SESSION['customer_temp']['email'] ?? '';
    $name = $_SESSION['customer_temp']['name'] ?? '';
    $zipcode = $_SESSION['customer_temp']['zipcode'] ?? '';
    
    // 読み込み後、一時セッション情報をクリア
    unset($_SESSION['customer_temp']);
}

// 2. 認証済みユーザーの情報をチェック（更新画面として使う場合）
// 一時セッション情報がない場合のみ、$_SESSION['customer'] から読み込む
elseif (isset($_SESSION['customer'])) {
    $email = $_SESSION['customer']['email'];
    $name = $_SESSION['customer']['name'];
    $zipcode = $_SESSION['customer']['zipcode'];
    // $pass はハッシュ値のため、フォームには表示しません
}

// 3. エラーメッセージの読み込みとクリア
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>新規会員登録</title>
<link rel="stylesheet" href="css/header2.css">
<link rel="stylesheet" href="css/会員登録画面.css"> 
</head>
<body>
    <?php require 'header2.php'; ?>

<div class="container">
    <h2>新規会員登録</h2>
    
    <div class="error">
        <?php echo htmlspecialchars($error_message); ?> 
    </div>
    
    <form action="会員登録完了画面.php" method="post">
        <label>メールアドレス <span class="required">必須</span></label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    
        <label>パスワード <span class="required">必須</span></label>
        <input type="password" name="password" value="" required>
        <p class="note">ログイン時に使用するためのものです</p>
    
        <label>アカウント名 <span class="required">必須</span></label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        <p class="note">他の会員に表示されます</p>
    
        <label>郵便番号 <span class="required">必須</span></label>
        <input type="text" name="zipcode" placeholder="例）123-0000" maxlength="8" autocomplete="postal-code" value="<?php echo htmlspecialchars($zipcode); ?>" required>
    
        <button type="submit" class="btn">登録</button>
    </form>
    
    <div class="login-link">
        既に登録済み（ログイン）の方は <a href="ログイン画面.php">こちら</a>
    </div>
</div>
    
</body>
</html>