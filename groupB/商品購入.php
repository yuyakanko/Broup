<?php session_start() ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/header1.css?ver=2">
  <link rel="stylesheet" href="css/商品購入.css">
  <title>商品購入</title>
</head>
<body>
     <?php require 'header1.php'?>
    <div class="main">
    <?php
        require "データベース.php";
        $pdo = new PDO($connect, USER, PASS);
        if (!empty($_SESSION['cart']) && isset($_SESSION['customer'])) {
            echo '<div class="carousel">';
            $user_id = $_SESSION['customer']['id'];
            foreach ($_SESSION['cart'] as $item) {
                $cart_id = $item['id'];
                $img = $item['img'];
                $name = $item['name'];
                $date = date("Y-m-d H:i:s");
                echo '<div class="carousel-slide">';
                    echo '<img src="' . htmlspecialchars($img) . '" alt="商品画像">';
                    echo '<p>' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>';
                    $sql=$pdo->prepare("INSERT INTO buy_information (purchase_date,item_id,user_id) VALUES(?,?,?)");
                    $sql->execute([$date,$cart_id,$user_id]);
                echo '</div>';
            }
            echo '</div>';
            echo '<div class="confirmation-wrap">';
                echo '<div class="confirmation-text">';
                    echo '購入完了しました<br>ご利用ありがとうございます。';
        }
        else{
            echo '<div class="confirmation-wrap">';
                echo '<div class="confirmation-text">';
                echo '商品を選択してください。';
        }
            echo '</div>';
            echo '<a href="homePage.php"><button class="homebutton">ホームへ</button></a>';
        echo '</div>';
      unset($_SESSION['cart']);
    ?>
  </div>
</body>
</html>
