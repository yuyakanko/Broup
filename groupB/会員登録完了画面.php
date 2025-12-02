<?php
session_start();
require 'データベース.php'; 

// ★ PHPロジックをファイルの冒頭にまとめる

// 入力値の取得
$input_email = $_POST['email'] ?? '';
$input_password = $_POST['password'] ?? '';
$input_name = $_POST['name'] ?? '';
$input_zipcode = $_POST['zipcode'] ?? '';

// データベース接続
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'データベース接続に失敗しました: ' . $e->getMessage();
    exit();
}

// 重複チェック (user_mail)
if (isset($_SESSION['customer'])) {
    $id = $_SESSION['customer']['id'];
    $sql = $pdo->prepare('select * from user where user_id != ? and user_mail = ?');
    $sql->execute([$id, $input_email]);
} else {
    $sql = $pdo->prepare('select * from user where user_mail = ?');
    $sql->execute([$input_email]);
}

if (!empty($sql->fetchAll())) {
    // 重複がある場合、リダイレクト
    $_SESSION['error_message'] = 'ログイン名（メールアドレス）がすでに使用されていますので、変更してください。';
    
    // 一時セッション変数にデータを格納 (アカウント名、メールアドレスが正しく区別されている)
    $_SESSION['customer_temp'] = [
        'email' => $input_email,
        'name' => $input_name,
        'zipcode' => $input_zipcode
    ];

    header('Location: 会員登録画面.php'); 
    exit();
}

// 重複がなかった場合、登録/更新処理
$hashed_password = password_hash($input_password, PASSWORD_DEFAULT);
$message_main = '会員登録が完了しました';

if (isset($_SESSION['customer'])) {
    // 既存ユーザーの登録情報更新
    $id = $_SESSION['customer']['id'];
    $sql = $pdo->prepare(
        'update user set account_name = ?, postal_code = ?, user_mail = ?, password = ? where user_id = ?'
    );
    $sql->execute([
        $input_name, $input_zipcode, $input_email, $hashed_password, $id
    ]);
    
    // セッション情報の更新
    $_SESSION['customer'] = [
        'id' => $id,
        'name' => $input_name,
        'zipcode' => $input_zipcode,
        'email' => $input_email,
        'password' => $hashed_password // パスワードは新しいハッシュ値に更新
    ];
    
    $message_main = '登録情報の変更が完了しました';
    
} else {
    // 新規会員登録
    $sql = $pdo->prepare('insert into user values(null, ?, ?, ?, ?)');
    $sql->execute([
        $input_name,
        $hashed_password,
        $input_email,
        $input_zipcode
    ]);

    $user_id = $pdo->lastInsertId();

    $_SESSION['customer'] = [
        'id' => $user_id,
        'name' => $input_name,
        'zipcode' => $input_zipcode,
        'email' => $input_email,
        'password' => $hashed_password
    ];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/会員登録完了画面.css">
</head>
<body>
    <?php require 'header2.php'; ?>
    
    <div class="container">
        <div class="content">
            <p class="message-main"><?php echo $message_main; ?></p>
            <p class="message-sub">グッズフリマへようこそ！</p>
            <a href="homePage.php" class="button">ホームへ</a>
        </div>
    </div>
</body>
</html>