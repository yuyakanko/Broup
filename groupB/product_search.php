<?php
    const SERVER = 'mysql327.phy.lolipop.lan';
    const DBNAME = 'LAA1607651-system';
    const USER = 'LAA1607651';
    const PASS = 'asosd2cb';

    $const = 'mysql:host='.SERVER.';dbname='.DBNAME.';charaset=utf8';
?>
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
    </div>
    <a href="#" class="horma">＜ホームへ</a><br>
    <h1>検索結果</h1>
    <div class="product-list">
        <div class="product-card">
            <div class="product-image">
                <img src="image/image1.jpg">
            </div>
            <div class="product-price">¥500 
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="fa fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                <img src="image/image2.jpg">
            </div>
            <div class="product-price">¥500
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="fa fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                <img src="image/image1.jpg">
            </div>
            <div class="product-price">¥500 
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="fa fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                <img src="image/image3.jpg">
            </div>
            <div class="product-price">¥500 
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="fa fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                <img src="image/image2.jpg">
            </div>
            <div class="product-price">¥500 
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="fa fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                <img src="image/image2.jpg">
            </div>
            <div class="product-price">¥500 
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="fa fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
        <div class="product-card">
            <div class="product-image">
                <img src="image/image1.jpg">
            </div>
            <div class="product-price">¥500 
                <span class="heart">
                    <button class="favorite-btn">
                        <i class="far fa-heart"></i>
                    </button>
                </span>
            </div>
            <div class="product-description">
                商品説明
            </div>
        </div>
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