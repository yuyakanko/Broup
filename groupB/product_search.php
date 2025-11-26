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
    <div>
        <?php require "header3.php"?>
        <?php require "データベース.php"?>
    </div>
    <a href="#" class="horma">＜ホームへ</a><br>
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
                    $mysql=$pdo->prepare("SELECT * FROM product_image WHERE sort_order = 1 AND item_id = ?");
                    $mysql->execute([$key['item_id']]);
                    echo '<div class="product-card">';
                        foreach($mysql as $row){
                            echo '<div class="product-image">';
                                echo '<a href="商品詳細.php?item_id=',$row['item_id'],'">';
                                    echo '<img src="',$row['product_path'],'">';
                                echo '</a>';
                            echo '</div>';
                            break;
                        }
                        echo '<div class="product-price">¥',$key['product_price'],' ';
                            echo '<span class="heart">';
                                echo '<button class="favorite-btn">';
                                    echo '<i class="fa fa-heart"></i>';
                                echo '</button>';
                            echo '</span>';
                        echo '</div>';
                        echo '<div class="product-description">';
                            echo '商品説明';
                            echo '<p>',$key['product_description'],'</p>';
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
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } 
            else{
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        });
    });
    </script>
</body>
</html>