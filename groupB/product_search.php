<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="css/product_search.css?ver=3">
    <link rel="stylesheet" href="css/header3.css?ver=3">
    <title>商品検索</title>
</head>
<body>
    <?php require "header3.php"?>
    <?php require "データベース.php"?>
    <a href="homePage.php" class="horma">＜ホームへ</a><br>
    <h1>検索結果</h1>
    <?php 
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            $pdo = new PDO ($connect , USER , PASS);
            $sql=$pdo->prepare("SELECT * FROM item_information WHERE product_name LIKE ?");
            $sql->execute(["%".$_POST['search']."%"]);
        }
    ?>
    <div class="product-list">
        <?php
            if(isset($sql)){
                foreach($sql as $key){
                    $boo = false;
                    $lisql=$pdo->prepare("SELECT * FROM buy_information WHERE item_id = ?");
                    $lisql->execute([$key['item_id']]);
                    if($lisql->rowCount() > 0){
                        continue;
                    }
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $newkey => $value){
                            if($key['item_id'] == $value['id']){
                                $boo = true;
                            }
                        }
                    }
                    if($boo){
                        continue;
                    }
                    $mysql=$pdo->prepare("SELECT * FROM product_image WHERE sort_order = 1 AND item_id = ?");
                    $mysql->execute([$key['item_id']]);
                    $mtsql = $pdo->prepare("SELECT * FROM favorite WHERE item_id = ? AND user_id = ?");
                    $mtsql->execute([$key['item_id'], $_SESSION['customer']['id'] ?? null]);
                    $isboo = $mtsql->rowCount() > 0;
                    $boois = $isboo ? 'fas' : 'far';
                    echo '<div class="product-card">';
                        foreach($mysql as $row){
                            echo '<div class="product-image">';
                                echo '<a href="商品詳細.php?item_id=',htmlspecialchars($row['item_id']),'">';
                                    echo '<img src="',htmlspecialchars($row['product_path']),'">';
                                echo '</a>';
                            echo '</div>';
                            break;
                        }
                        echo '<div class="product-price">¥',htmlspecialchars($key['product_price']),' ';
                            echo '<span class="heart">';
                                echo '<button class="favorite-btn" data-item-id="' .htmlspecialchars($key['item_id']) .'">';
                                    echo '<i class="fa fa-heart '. htmlspecialchars($boois) .'"></i>';
                                echo '</button>';
                            echo '</span>';
                        echo '</div>';
                        echo '<div class="product-description">';
                            echo '商品説明';
                            echo '<p>',htmlspecialchars($key['product_description']),'</p>';
                        echo '</div>';
                    echo '</div>';
                    }
            }
            else{
                echo '検索された名が含まれる商品はありませんでした';
            }
        ?>
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