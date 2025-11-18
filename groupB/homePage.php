<?php
// 1. セッションを開始
session_start();
require 'データベース.php';


// 2. ログイン状態の確認
$is_logged_in = isset($_SESSION['customer']);
$user_name = '';

if ($is_logged_in) {
    // ログインしている場合、セッションからユーザー名を取得
    $user_name = $_SESSION['customer']['name'];
}

// ★★★ 修正: header3.php の読み込みを <head> より前に記述するのをやめました ★★★
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オタクグッズフリマ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header3.css">
    <link rel="stylesheet" href="css/homePage.css">
</head>
<body>

    <?php require 'header3.php'; ?>
    <div id="wrapper">
        <div class="logo-banner-wrapper">
            <div class="logo-banner-image"></div> 
        </div>

        <main class="container">
            <?php if ($is_logged_in): ?>
                <h3 class="welcome-message">ようこそ、<?php echo htmlspecialchars($user_name); ?>さん！</h3>
            <?php endif; ?>

            <h2 class="section-title">おすすめ</h2>
            <div class="product-grid">
                <?php 
                $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->query('select * from item_information');
                foreach ($sql as $row) {
                    echo '<div class="product-item">';
                    echo '<div class="product-image"><img alt="商品画像" src="image/' . htmlspecialchars($row['item_id']) . '.jpg"></div>';
                      echo '<div class="product-info">';
                       echo '<span class="price">￥  '. htmlspecialchars($row['product_price']) .'</span>';
                       echo '<span class="heart-icon">♡</span>';
                       echo '<p class="description">'. htmlspecialchars($row['product_description']) .'</p>';
                      echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <h2 class="section-title board-title">掲示板</h2>
            <div class="board-grid">
                <div class="board-item">ゲーム</div>
                <div class="board-item">アニメ</div>
                <div class="board-item">アイドル</div>
                <div class="board-item">ブランド</div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const heartIcons = document.querySelectorAll('.heart-icon');

            heartIcons.forEach(icon => {
                icon.addEventListener('click', () => {
                    icon.classList.toggle('liked');
                    
                    if (icon.classList.contains('liked')) {
                        icon.textContent = '♥'; // 塗りつぶしハート
                    } else {
                        icon.textContent = '♡'; // 白抜きハート
                    }
                });
            });
        });
    </script>
</body>
</html>