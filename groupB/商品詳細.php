<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/header1.css?ver=2">
<title>商品詳細</title>
<style>
  body { 
    font-family: sans-serif; 
    background:#fafafa; 
  }

  header { 
    background:#f9f06b; 
    padding:10px 20px; 
    display:flex; 
    align-items:center; 
    justify-content:space-between; 
  }

  header .left { 
    display:flex; 
    align-items:center; 
    gap:15px; 
  }

  header input { 
    padding:5px 10px; 
    width:200px; 
  }

  header .right button { 
    background:#ff5555; 
    border:none; 
    padding:8px 15px; 
    border-radius:20px; 
    color:#fff; 
  }

  .container { 
    display:flex; 
    padding:30px; 
    gap:40px; 
  }

  .image-box { 
    width:350px; 
    height:350px; 
    background:#ddd; 
    display:flex; 
    flex-direction:column; 
    align-items:center; 
    justify-content:center; 
    position:relative; 
  }

  .image-box .nav-left, .image-box .nav-right { 
    position:absolute; 
    top:50%; 
    transform:translateY(-50%); 
    font-size:24px; cursor:pointer; 
  }

  .nav-left { 
    left:10px; 
  }

  .nav-right { 
    right:10px; 
  }

  .image-box .count { 
    margin-top:20px; 
  }

  .details { 
    flex:1; 
  }

  .details h1 { 
    font-size:24px; 
    margin-bottom:10px; 
  }

  .price { 
    font-size:18px; 
    margin-bottom:20px; 
  }

  .btns form{
    display: inline-block;
    margin: 0;
  }

  .btns form button { 
    margin-right:10px; 
    padding:8px 15px; 
    border:none; 
    border-radius:15px; 
    cursor:pointer; 
  }

  .cart { 
    background:#6cf58a; 
  }

  .buy { 
    background:#84c6ff; 
  }

  .section { 
    margin-top:20px; 
  }

  textarea { 
    width:80%; 
    height:60px; 
    padding:10px; 
  }

  .hoa {
    text-decoration: none;
    color: #000000;
  }

</style>
</head>
<body>
  <?php require 'header1.php'?>
  <?php require "データベース.php"?>
  <?php
    $pdo=new PDO($connect, USER , PASS);
    if($_GET['item_id']){
      $item_id = $_GET['item_id'];
      $sql=$pdo->prepare('SELECT * FROM item_information WHERE item_id = ?');
      $sql->execute([$item_id]);
      $item = $sql->fetch();

      if(isset($item)){
        $gener=$pdo->prepare('SELECT * FROM genre WHERE genre_id = ?');
        $gener->execute([$item['genre_id']]);
        $genre = $gener->fetch();

        $sql = $pdo->prepare("UPDATE item_information SET view_times = view_times + 1 WHERE item_id = ?");
        $sql->execute([$item_id]);
      }
    }
  ?>
  <a href="homePage.php" class="hoa">＜ホームへ</a>
  <div class="container">
    <div class="image-box">
    <div class="nav-left"><</div>
    <div class="nav-right">></div>
      <img src="" alt="商品画像" width="100" />
    <div class="count"></div>
  </div>

  <div class="details">
    <?php
      if(isset($item)){
        echo  '<h1>',htmlspecialchars($item['product_name']),'</h1>';

        echo '<div class="price">値段（￥',htmlspecialchars($item['product_price']),'）</div>';
      }
    ?>

    <div class="btns">
      <form action="カート.php" method="POST">
        <input type="hidden" name="cart_item" value="<?php echo $item_id?>">
        <button class="cart">カートへ</button>
      </form>
      <form action="購入予定.php" method="POST">
        <input type="hidden" name="purchase_item" value="<?php echo $item_id?>">
        <button class="buy">購入手続きへ</button>
      </form>
    </div>

    <div class="section">
      <?php
        if(isset($genre)){
          echo '<strong>ジャンル</strong>　',htmlspecialchars($genre['genre_name']);
        }
      ?>
    </div>

    <div class="section">
      <strong>商品状態</strong><br />
      <?php
        if(isset($item)){
          echo '<textarea placeholder="テキストエリア">',htmlspecialchars($item['product_description']),'</textarea>';
        }
      ?>
    </div>

    <div class="section">
      <strong>商品説明</strong><br />
      <?php
        if(isset($item)){
          echo '<textarea placeholder="テキストエリア">',htmlspecialchars($item['product_state']),'</textarea>';
        }
      ?>
    </div>
  </div>
</div>

<script>
// 商品画像配列（好きな画像URLを入れて）
const images = <?php
  if($_GET['item_id']){
    $mysql=$pdo->prepare('SELECT * FROM product_image WHERE item_id = ?');
    $mysql->execute([$item_id]);
    foreach($mysql as $key){
      $paths [] = $key['product_path'];
    }

    echo json_encode($paths, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  }
?>;
</script>
<script>
let index = 0;
const imgTag = document.querySelector('.image-box img');
const countTag = document.querySelector('.image-box .count');
imgTag.src = images[index];
countTag.textContent = `${index+1}/${images.length}`;

document.querySelector('.nav-left').onclick = () => {
  index = (index - 1 + images.length) % images.length;
  imgTag.src = images[index];
  countTag.textContent = `${index+1}/${images.length}`;
};

document.querySelector('.nav-right').onclick = () => {
  index = (index + 1) % images.length;
  imgTag.src = images[index];
  countTag.textContent = `${index+1}/${images.length}`;
};
</script>
</body>
</html>
