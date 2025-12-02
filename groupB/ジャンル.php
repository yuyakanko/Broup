<?php
// 1. セッションを開始
session_start();
require 'データベース.php';


// 2. ログイン状態の確認
$is_logged_in = isset($_SESSION['customer']);
$user_name = '';

if(isset($_GET['genre_id'])){
    $genre_id = $_GET['genre_id'];
    $pdo=new PDO($connect, USER, PASS);
    $insql=$pdo->prepare("SELECT * FROM genre WHERE genre_id = ?");
    $insql->execute([$genre_id]);
    $genre = $insql->fetch();

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php 
            if($genre){
                echo htmlspecialchars($genre['genre_name']).'画面';
            }
            else{
                echo '各ジャンル画面';
            } 
        ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header3.css">
    <link rel="stylesheet" href="css/homePage.css?ver=1">
</head>
<body>

    <?php require 'header3.php'; ?>
    <div id="wrapper">
        <main class="container">
            <h2 class="section-title">
                <?php 
                    if($genre){
                        echo $genre['genre_name'];
                    }
                ?>
            </h2>
            <div class="product-grid">
                <?php 
                $customerid = $_SESSION['customer']['id'];
                $sql=$pdo->prepare('SELECT * FROM item_information WHERE user_id = ? AND genre_id = ?');
                $sql->execute([$customerid,$genre_id]);
                foreach ($sql as $row) {
                    $boo = false;
                    $lisql=$pdo->prepare("SELECT * FROM buy_information WHERE item_id = ?");
                    $lisql->execute([$row['item_id']]);
                    if($lisql->rowCount() > 0){
                        continue;
                    }
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $newkey => $value){
                            if($row['item_id'] == $value['id']){
                                $boo = true;
                            }
                        }
                    }
                    if($boo){
                        continue;
                    }
                    $mysql=$pdo->prepare("SELECT * FROM product_image WHERE item_id = ?");
                    $mysql->execute([$row['item_id']]);
                    $item = $mysql->fetch();

                    $mtsql = $pdo->prepare("SELECT * FROM favorite WHERE item_id = ? AND user_id = ?");
                    $mtsql->execute([$row['item_id'], $customerid ?? null]);
                    $isboo = $mtsql->rowCount() > 0;
                    $boois = $isboo ? 'fas' : 'far';

                    echo '<div class="product-item">';
                    echo '<a href="商品詳細.php?item_id=',htmlspecialchars($row['item_id']),'">';
                    echo '<div class="product-image"><img alt="商品画像" src="' . htmlspecialchars($item['product_path']) . '"></div>';
                    echo '</a>';
                        echo '<div class="product-info">';
                            echo '<span class="price">￥  '. htmlspecialchars($row['product_price']) .'</span>';
                            echo '<button class="favorite-btn" data-item-id="' .htmlspecialchars($row['item_id']) .'">';
                                echo '<i class=" '.htmlspecialchars($boois).' fa-heart"></i>';
                            echo '</button>';
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
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const icon = btn.querySelector('i');
                const itemId = btn.getAttribute('data-item-id');

                fetch('お気に入り追加.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `item_id=${itemId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    } else if (data.status === 'removed') {
                        icon.classList.remove('fas');
                    icon.classList.add('far');
                    }
                    console.log(data);
                });
            });
        });
    </script>
</body>
</html>
