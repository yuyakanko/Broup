<?php session_start()?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product_listing_confirmation.css">
    <link rel="stylesheet" href="css/header1.css">
    <title>商品出品</title>
</head>
<body>
    <?php require 'header1.php'?>
    <div class="main">
        <?php
            //$pdo=new PDO($const,USER,PASS);

            //if(isset($_SESSION['confirmation'])){
                //$confirmation = SESSION['confirmation']['img'];
                //foreach($confirmation as $key => $value){
                    //$img = $_SESSION['confirmation']['img'];
                    //$price = $_SESSION['confirmation']['price'];
                    //$description = $_SESSION['confirmation']['description'];
                    //$name = $_SESSION['confirmation']['name'];
                    echo '<div class="carousel">';
                        echo '<div class="carousel-track">';
                            echo '<div class="carousel-slide">';
                                echo '<img src="image/image1.jpg" alt="画像1">';
                            echo '</div>';
                            echo '<div class="carousel-slide">';
                                echo '<img src="image/image2.jpg" alt="画像2">';
                            echo '</div>';
                            echo '<div class="carousel-slide">';
                                echo '<img src="image/image3.jpg" alt="画像3">';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="iii">';
                            echo '1/4';
                        echo '</div>';
                        echo '<button class="carousel-button prev">←</button>';
                        echo '<button class="carousel-button next">→</button>';
                    echo '</div>';
                //}
            //}
            echo '';
            echo '出品確認しました';
            echo 'ご利用ありがとうございます。';
            echo '<button>ホームへ</button>';
        ?>
    </div>
    <script>
        let currentIndex = 0;

        const track = document.querySelector('.carousel-track');
        const slides = document.querySelectorAll('.carousel-slide');

        const slideWidth = slides[0].getBoundingClientRect().width;
        track.style.width = `${slideWidth * slides.length}px`;

        function updateCarousel() {
            track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
        }

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