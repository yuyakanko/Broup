<?php
session_start();
require 'データベース.php'; 

// ★★★ 修正箇所: ログイン画面に不要な一時セッション情報をクリア ★★★
// 会員登録画面からのリダイレクトで残ったデータをここで消去し、影響を遮断
if (isset($_SESSION['customer_temp'])) {
    unset($_SESSION['customer_temp']);
}
// ----------------------------------------------------

$error_message = '';
$pdo = null;

// POSTされていない場合でもWarningが出ないよう、ここで初期化
$input_name = $_POST['name'] ?? ''; 
$input_password = $_POST['password'] ?? ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // フォームからの入力値の整理
    $input_name = trim($input_name);
    $input_password = trim($input_password);

    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = 'データベース接続に失敗しました。';
    }
    
    if ($pdo) {
        try {
            // アカウント名 (account_name) で検索
            $sql = $pdo->prepare('SELECT * FROM user WHERE account_name = ?');
            $sql->execute([$input_name]);
            $customer = $sql->fetch(PDO::FETCH_ASSOC);

            // 認証処理
            if ($customer && password_verify($input_password, $customer['password'])) {
                
                // 認証成功
                $_SESSION['customer'] = [
                    'id' => $customer['user_id'],
                    'name' => $customer['account_name'],
                    'email' => $customer['user_mail'],
                    'zipcode' => $customer['postal_code'],
                    'password' => $customer['password']
                ];

                header('Location: homePage.php'); 
                exit();

            } else {
                $error_message = 'アカウント名または、パスワードが異なります';
            }
        } catch (PDOException $e) {
            $error_message = '認証処理中にエラーが発生しました。';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>オタグッズ - ログイン</title>
<link rel="stylesheet" href="css/ログイン画面.css">
<style>
.error-message {
    color: red;
    font-size: 14px;
    text-align: center;
    margin-bottom: 10px;
}
</style>
<link rel="stylesheet" href="css/header2.css">
</head>

<body>
<?php require 'header2.php'; ?>
<main>
<div class="login-box">
<h2>ログイン</h2>
<form action="ログイン画面.php" method="post">
    <label>アカウント名</label>
    <input type="text" name="name" required value="<?php echo htmlspecialchars($input_name); ?>"> 
    
    <label>パスワード</label>
    <input type="password" name="password" required>

    <?php if ($error_message): ?>
        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p> 
    <?php else: ?>
        <p class="error-message">&nbsp;</p> 
    <?php endif; ?>

    <button type="submit">ログイン</button>
</form>

<div class="register">会員登録（アカウント作成）の方は
       <a href="会員登録画面.php">こちら</a>
</div>
</div>
</main>
</body>
</html>