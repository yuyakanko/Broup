<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Cart Preview</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: "YuGothic", sans-serif; }
    body { background: #ffffff; }
    .app { width: 100vw; height: 100vh; border: none; margin: 0; overflow: auto; }
    header { height: 40px; background: #fff99a; display: flex; align-items: center; padding: 0 10px; }
    .logo { font-size: 12px; margin-right: 10px; }
    .search-area { flex: 1; display: flex; align-items: center; }
    .search-input { width: 100%; height: 22px; border: 1px solid #888; padding: 0 6px; font-size: 12px; }
    .search-button { width: 24px; height: 24px; border: 1px solid #888; border-left: none; font-size: 14px; cursor: pointer; background: #ffffff; }
    .header-right { display: flex; align-items: center; margin-left: 10px; gap: 5px; }
    .user-icon { width: 22px; height: 22px; border-radius: 50%; background: #dcdcdc; }
    .logout-btn { background: #ff0000; color: #fff; border: none; font-size: 11px; padding: 5px 10px; cursor: pointer; }
    main { padding: 10px; font-size: 12px; }
    .back-link { margin-bottom: 8px; }
    .content { display: flex; align-items: flex-start; justify-content: center; gap: 40px; padding-top: 20px; }
    .items { width: 50%; max-width: 600px; }
    .cart-item { display: flex; margin-bottom: 15px; }
    .item-image { width: 170px; height: 170px; background: #dcdcdc; display: flex; justify-content: center; align-items: center; margin-right: 10px; font-size: 40px; }
    .item-right { flex: 1; display: flex; flex-direction: column; }
    .delete-btn { background: #ff0000; color: #fff; border: none; padding: 8px 18px; font-size: 14px; cursor: pointer; border-radius: 4px; align-self: flex-start; margin-bottom: 18px; }
    .item-name { font-size: 16px; margin-bottom: 4px; }
    .item-price { font-size: 13px; }
    .underline { text-decoration: underline; }
    .checkout-area { width: 30%; min-width: 250px; display: flex; justify-content: center; align-items: flex-start; padding-top: 40px; }
    .checkout-btn { width: 170px; height: 120px; border-radius: 10px; border: none; background: #33cfff; cursor: pointer; font-size: 18px; }
  </style>
</head>
<body>
<div class="app">
  
  <main>
    <div class="back-link"><span>&lt; ホームへ</span></div>
    <div class="content">
      <div class="items">
        <div class="cart-item"><div class="item-image">🖼</div><div class="item-right"><button class="delete-btn">削除</button><p class="item-name">商品A</p><p class="item-price">値段（￥500）</p></div></div>
        <div class="cart-item"><div class="item-image">🖼</div><div class="item-right"><button class="delete-btn">削除</button><p class="item-name">商品B</p><p class="item-price">値段（￥100）</p></div></div>
        <div class="cart-item"><div class="item-image">🖼</div><div class="item-right"><button class="delete-btn">削除</button><p class="item-name">商品C</p><p class="item-price underline">値段（￥600）</p></div></div>
      </div>
      <div class="checkout-area"><button class="checkout-btn">購入手続きへ</button></div>
    </div>
  </main>
</div>
</body>
</html>
