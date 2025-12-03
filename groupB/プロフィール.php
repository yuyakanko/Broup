<?php session_start();?>
<!DOCTYPE html>

<?php
    $error_message = '';
    if (isset($_SESSION['error_message'])) {
        $error_message = $_SESSION['error_message'];
        unset($_SESSION['error_message']);
    }
?>

<html lang="ja">
<?php require 'データベース.php'; ?>
<head>
  <meta charset="UTF-8">
  <title>プロフィール</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
  <link rel="stylesheet" href="css/プロフィール.css">
  <link rel="stylesheet" href="css/header1.css">
</head>
<body>
    <?php
        if($_SESSION['customer']){
            $user_id = $_SESSION['customer']['id'];
            $pass = $_SESSION['customer']['password'];
            $pdo=new PDO($connect,USER,PASS);
            $sql=$pdo->prepare("SELECT * FROM user WHERE user_id = ?");
            $sql->execute([$user_id]);
            $user = $sql->fetch(PDO::FETCH_ASSOC);

        }
    ?>
    <?php require 'header1.php'; ?>
    <a href="homePage.php" class="hoa">＜ホームへ</a>
    <main>
        <div class="profile-container">
            <h2 class="profile-title">プロフィール</h2>
            <div class="avatar">
                <i class="fas fa-user-circle fa-7x"></i>
            </div>
            <div class="profile-content">
                <div class="member-info">
                    <h3 class="info-title">会員情報</h3>
                    <?php if(!empty($error_message)): ?>
                        <div class="error-message">
                            <?php echo htmlspecialchars($error_message); ?>
                        </div>
                    <?php endif; ?>
                    <form action="プロフィール更新.php" method="POST">
                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input type="email" id="email" name="email"
                            value="<?php if(isset($user)){echo htmlspecialchars($user['user_mail']);}?>">
                        </div>
                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input type="password" id="password" name="password" 
                            value="<?php if(isset($$user)){echo htmlspecialchars($$user['password']);}?>">
                            <button type="button" class="show-password">ログイン時に表示にします</button>
                        </div>

                        <div class="form-group">
                            <label for="account_name">アカウント名</label>
                            <input type="text" id="account_name" name="account_name" 
                            value="<?php if(isset($user)){echo htmlspecialchars($user['account_name']);}?>">
                        </div>
                        <div class="form-group">
                            <label for="postal_code">郵便番号</label>
                            <input type="text" id="postal_code" name="postal_code" 
                            value="<?php if(isset($user)){echo htmlspecialchars($user['postal_code']);}?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="change-btn">変更</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  </main>
</body>
</html>

