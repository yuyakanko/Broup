<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>商品詳細</title>
<style>
  body { font-family: sans-serif; background:#fafafa; }
  header { background:#f9f06b; padding:10px 20px; display:flex; align-items:center; justify-content:space-between; }
  header .left { display:flex; align-items:center; gap:15px; }
  header input { padding:5px 10px; width:200px; }
  header .right button { background:#ff5555; border:none; padding:8px 15px; border-radius:20px; color:#fff; }

  .container { display:flex; padding:30px; gap:40px; }
  .image-box { width:350px; height:350px; background:#ddd; display:flex; flex-direction:column; align-items:center; justify-content:center; position:relative; }
  .image-box .nav-left, .image-box .nav-right { position:absolute; top:50%; transform:translateY(-50%); font-size:24px; cursor:pointer; }
  .nav-left { left:10px; }
  .nav-right { right:10px; }

  .image-box .count { margin-top:20px; }
  .details { flex:1; }
  .details h1 { font-size:24px; margin-bottom:10px; }
  .price { font-size:18px; margin-bottom:20px; }

  .btns button { margin-right:10px; padding:8px 15px; border:none; border-radius:15px; cursor:pointer; }
  .cart { background:#6cf58a; }
  .buy { background:#84c6ff; }

  .section { margin-top:20px; }
  textarea { width:80%; height:60px; padding:10px; }
</style>
</head>
<body>
<div class="container">
  <div class="image-box">
    <div class="nav-left"><</div>
    <div class="nav-right">></div>
    <img src="" alt="商品画像" width="100" />
    <div class="count">1/4</div>
  </div>

  <div class="details">
    <h1>商品名</h1>
    <div class="price">値段（￥500）</div>

    <div class="btns">
      <button class="cart">カートへ</button>
      <button class="buy">購入手続きへ</button>
    </div>

    <div class="section">
      <strong>ジャンル</strong>　ゲーム
    </div>

    <div class="section">
      <strong>商品状態</strong><br />
      <textarea placeholder="テキストエリア"></textarea>
    </div>

    <div class="section">
      <strong>商品説明</strong><br />
      <textarea placeholder="テキストエリア"></textarea>
    </div>
  </div>
</div>

<script>
// 商品画像配列（好きな画像URLを入れて）
const images = [
  "https://via.placeholder.com/300?text=1",
  "https://via.placeholder.com/300?text=2",
  "https://via.placeholder.com/300?text=3",
  "https://via.placeholder.com/300?text=4"
];

let index = 0;
const imgTag = document.querySelector('.image-box img');
const countTag = document.querySelector('.image-box .count');
imgTag.src = images[index];
countTag.textContent = `${index+1}/4`;

document.querySelector('.nav-left').onclick = () => {
  index = (index - 1 + images.length) % images.length;
  imgTag.src = images[index];
  countTag.textContent = `${index+1}/4`;
};

document.querySelector('.nav-right').onclick = () => {
  index = (index + 1) % images.length;
  imgTag.src = images[index];
  countTag.textContent = `${index+1}/4`;
};
</script>
</body>
</html>
