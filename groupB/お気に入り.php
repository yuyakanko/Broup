<?php session_start();?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>お気に入り | サクサク</title>
  <link rel="stylesheet" href="css/お気に入り.css">
  <link rel="stylesheet" href="css/header1.css">
</head>
<body>
  <?php require "header1.php"?>
  <?php require "データベース.php"?>
  <a href="homePage.php" class="back-link">＜ ホームへ</a>
  <main class="container" role="main">
    <h1 class="page-title">お気に入り</h1>
    <?php 
      $pdo=new PDO($connect,USER,PASS);

      if(isset($_POST['deleteID'])){
        $deleteID = $_POST['deleteID'];
        $isql=$pdo->prepare("DELETE FROM favorite WHERE item_id = ?");
        $isql->execute([$deleteID ]);
      }

      if(isset($_SESSION['customer'])){
        $user_id = $_SESSION['customer']['id'];
        $sql=$pdo->prepare("SELECT * FROM favorite WHERE user_id = ?");
        $sql->execute([$user_id]);
        $ite = $sql->fetchAll(PDO::FETCH_ASSOC);
      }
    ?>
    <section class="favorites-list" aria-label="お気に入り商品一覧">
      <!-- 商品A -->
       <?php
        if(isset($ite)){
          foreach($ite as $newrow){
            $mysql=$pdo->prepare("SELECT * FROM item_information WHERE item_id = ?");
            $mysql->execute([$newrow['item_id']]);
            $favitem = $mysql->fetch();
          
            $newsql=$pdo->prepare("SELECT * FROM product_image WHERE item_id = ? AND sort_order = 1");
            $newsql->execute([$newrow['item_id']]);
            $oritem = $newsql->fetch();

            $lisql=$pdo->prepare("SELECT * FROM buy_information WHERE item_id = ?");
            $lisql->execute([$newrow['item_id']]);
            if($lisql->rowCount() > 0){
              continue;
            }

            echo '<article class="favorite-item">';
              echo '<img src="'.htmlspecialchars($oritem['product_path']).'" alt="'.htmlspecialchars($favitem['product_name']).'の画像" class="item-thumb" width="200" height="200" loading="lazy"/>';
              echo '<div class="item-info">';
                echo '<h2 class="item-name">'.htmlspecialchars($favitem['product_name']).'</h2>';
                echo '<p class="item-price">値段（¥'.htmlspecialchars($favitem['product_price']).'）</p>';
              echo '</div>';
              echo '<form action="お気に入り.php" method="POST">';
                echo '<input type="hidden" name="deleteID" value="'.htmlspecialchars($favitem['item_id']).'">';
                echo '<button class="delete-btn" type="submit" aria-label="商品Aを削除">削除</button>';
              echo '</form>';
            echo '</article>';
          }
        }
      ?>
    </section>
  </main>
</body>
</html>
