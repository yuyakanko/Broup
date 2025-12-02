<?php session_start()?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product_listing_confirmation.css">
    <link rel="stylesheet" href="css/header1.css?ver=4">
    <title>商品出品</title>
</head>
<body>
    <?php require 'header1.php'?>
    <?php require "データベース.php"?>
    <div class="main">
        <?php
            $pdo=new PDO($connect,USER,PASS);
            if(isset($_SESSION['confirmation'])){
                $confirmation = $_SESSION['confirmation']['img'];
                echo '<div class="carousel">';
                    echo '<div class="carousel-track">';
                        foreach($confirmation as $img){
                            echo '<div class="carousel-slide">';
                                echo '<img src="',htmlspecialchars($img),'" alt="画像1">';
                            echo '</div>';
                        }
                    echo '</div>';
                    echo '<div class="iii">';
                        echo '<span id="current-slide">1</span> / ' . htmlspecialchars(count($confirmation));
                    echo '</div>';
                    echo '<button class="carousel-button prev">&lt;</button>';
                    echo '<button class="carousel-button next">&gt;</button>';
                echo '</div>';
            }
            echo '';
            echo '<div class="confirmation-wrap">';
                echo '<div class="confirmation-text">';
                    echo '出品確認しました</br>';
                    echo 'ご利用ありがとうございます。';
                echo '</div>';
                echo '<a href="homePage.php"><button class="homebutton">ホームへ</button></a>';
            echo '</div>';
            unset($_SESSION['confirmation']['img']);
        ?>
    </div>
    <script>
        let currentIndex = 0;

    // ① 要素の取得
        const track = document.querySelector('.carousel-track');
        const slides = document.querySelectorAll('.carousel-slide');

    // ② スライド幅の取得と track の幅設定
        const slideWidth = slides[0].getBoundingClientRect().width;
        track.style.width = `${slideWidth * slides.length}px`;

    // ③ 表示更新関数
        //function updateCarousel() {
            //track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
        //}
        function updateCarousel() {
            track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
            document.getElementById('current-slide').textContent = currentIndex + 1;
        }

    // ④ ボタンの取得とイベント設定
        const prevButton = document.querySelector('.carousel-button.prev');
        const nextButton = document.querySelector('.carousel-button.next');

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < slides.length - 1) {
                currentIndex++;
                updateCarousel();
            }
        });
    </script>
</body>
</html>