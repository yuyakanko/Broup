<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お気に入り</title>
<style>
  body {
    font-family: "Meiryo", sans-serif;
    background-color: #fff8cc;
    margin: 0;
    padding: 0;
  }

  header {
    background-color: #fff8cc;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  header h1 {
    margin: 0;
    font-size: 18px;
  }

  .search-box {
    flex: 1;
    margin: 0 20px;
  }

  .search-box input {
    width: 100%;
    padding: 6px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  .logout-btn {
    background-color: red;
    color: white;
    border: none;
    padding: 6px 15px;
    border-radius: 15px;
    cursor: pointer;
  }

  .logout-btn:hover {
    background-color: #c00;
  }

  main {
    background-color: #fff;
    padding: 20px 40px;
  }

  .back-link {
    color: #333;
    font-size: 14px;
    text-decoration: none;
  }

  .back-link:hover {
    text-decoration: underline;
  }

  h2 {
    margin-top: 10px;
    margin-bottom: 20px;
  }

  .favorite-item {
    display: flex;
    align-items: center;
    background-color: #f2f2f2;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 15px;
  }

  .favorite-item img {
    width: 100px;
    height: 100px;
    background-color: #ccc;
    border-radius: 5px;
    object-fit: cover;
  }

  .info {
    flex: 1;
    padding-left: 15px;
  }

  .info p {
    margin: 5px 0;
  }

  .delete-btn {
    background-color: red;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 10px 15px;
    cursor: pointer;
    font-weight: bold;
  }

  .delete-btn:hover {
    background-color: #cc0000;
  }
</style>
</head>
<body>

<header>
  <h1>🍥 オタグッズ</h1>
  <div class="search-box">
    <input type="text" placeholder="探し物">
  </div>
  <button class="logout-btn">ログアウト</button>
</header>

<main>
  <a href="index.php" class="back-link">＜ ホームへ</a>

  <h2>お気に入り</h2>

  <!-- 商品A -->
  <div class="favorite-item">
    <img src="noimage.png" alt="商品A">
    <div class="info">
      <p>商品A</p>
      <p>値段（￥500）</p>
    </div>
    <form method="post" action="favorite_delete.php">
      <input type="hidden" name="id" value="1">
      <button class="delete-btn">削除</button>
    </form>
  </div>

  <!-- 商品B -->
  <div class="favorite-item">
    <img src="noimage.png" alt="商品B">
    <div class="info">
      <p>商品B</p>
      <p>値段（￥100）</p>
    </div>
    <form method="post" action="favorite_delete.php">
      <input type="hidden" name="id" value="2">
      <button class="delete-btn">削除</button>
    </form>
  </div>

  <!-- 商品C -->
  <div class="favorite-item">
    <img src="noimage.png" alt="商品C">
    <div class="info">
      <p>商品C</p>
      <p>値段（￥600）</p>
    </div>
    <form method="post" action="favorite_delete.php">
      <input type="hidden" name="id" value="3">
      <button class="delete-btn">削除</button>
    </form>
  </div>
</main>

</body>
</html>
