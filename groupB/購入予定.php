<?php
// cart.php — 購入予定（カート）画面（スタンドアロン／PHP）
session_start();
mb_internal_encoding('UTF-8');

// デモ用ダミーデータ初期化（本番はDBから読込）
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [
    ['id' => 'a1', 'name' => '商品A', 'price' => 500],
    ['id' => 'b2', 'name' => '商品B', 'price' => 100],
    ['id' => 'c3', 'name' => '商品C', 'price' => 600],
  ];
}

// CSRF（簡易）
if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['csrf'];

// 削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $postCsrf = $_POST['csrf'] ?? '';
  $action   = $_POST['action'] ?? '';
  $id       = $_POST['id'] ?? '';
  if (hash_equals($csrf, $postCsrf) && $action === 'remove' && $id !== '') {
    $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($it) use ($id){
      return $it['id'] !== $id;
    }));
  }
  // PRG パターンで再読込
  header('Location: '.$_SERVER['PHP_SELF']);
  exit;
}

$items = $_SESSION['cart'];
$total = array_sum(array_map(fn($i)=>$i['price'], $items));
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>購入予定（カート）</title>
  <style>
    :root{
      --bg:#2b2b2b;            /* 背景の暗めグレー（スクショ風） */
      --frame:#ffffff;         /* 白いコンテンツ面 */
      --brand:#fff68a;         /* 上部の薄い黄色バー */
      --text:#0f172a;          /* 文字 */
      --muted:#6b7280;         /* 補助文字 */
      --btn-red:#e60012;       /* 削除ボタン */
      --btn-red-h:#c80010;     /* 削除ホバー */
      --btn-next:#5ad8ff;      /* 購入手続きへ（空色） */
      --border:#cfd8e3;        /* 罫線 */
      --outline:#3b82f6;       /* フォーカス */
      --radius:6px;
      --shadow:0 0 0 2px #60a5fa, 0 8px 18px rgba(0,0,0,.18);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; background:var(--bg);
      font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Noto Sans JP","Hiragino Kaku Gothic ProN","Yu Gothic","YuGothic","Helvetica Neue",Arial,sans-serif;
      display:grid; place-items:center; padding:20px;
    }
    .app{ width: 700px; max-width: calc(100vw - 40px); background:var(--frame); border-radius:4px; box-shadow: var(--shadow); overflow:hidden; }
    .brandbar{ height:44px; background:var(--brand); display:flex; align-items:center; gap:10px; padding:0 12px; }
    .logo{ width:20px; height:20px; border-radius:4px; background:#ff9bd4; display:grid; place-items:center; font-size:12px; color:#fff }
    .brandname{ font-size:13px; color:#333 }

    .toolbar{ display:flex; align-items:center; gap:10px; margin-left:8px; }
    .search{ flex:1; display:flex; align-items:center; gap:6px; }
    .search input{ flex:1; height:28px; padding:0 8px; border:1px solid var(--border); border-radius:4px; }
    .search button{ height:28px; padding:0 10px; border:1px solid var(--border); background:#fff; border-radius:4px; cursor:pointer; }
    .logout{ margin-left:auto; background:#e60012; color:#fff; border:0; border-radius:14px; padding:6px 10px; cursor:pointer; font-size:12px; }

    .content{ padding:10px 14px 18px; }
    .breadcrumb{ color:#374151; font-size:13px; margin:8px 0 10px; }

    .nextwrap{ position:sticky; top:8px; float:right; margin:8px 6px 8px 16px; }
    .next{ background:var(--btn-next); color:#0f172a; border:0; padding:14px 18px; border-radius:8px; font-weight:700; cursor:pointer; }

    .list{ clear:both; display:grid; gap:18px; }
    .item{ display:grid; grid-template-columns: 120px 1fr auto; gap:16px; align-items:center; padding:12px; border:1px solid var(--border); border-radius:6px; }
    .thumb{ width:120px; height:120px; background:#ddd; border-radius:4px; display:grid; place-items:center; }
    .thumb svg{ width:56px; height:56px; color:#444 }
    .meta{ }
    .name{ font-size:20px; margin:0 0 6px; }
    .price{ color:#374151; }

    .remove{
      background:var(--btn-red); color:#fff; border:0; border-radius:999px; padding:8px 16px; font-weight:700; cursor:pointer;
    }
    .remove:hover{ background:var(--btn-red-h); }

    .total{ text-align:right; margin-top:16px; color:#111; font-weight:700; }
  </style>
</head>
<body>
  <div class="app">
    <div class="brandbar">
      <div class="logo">♪</div>
      <div class="brandname">オタグッズ</div>
      <div class="toolbar" style="width:100%">
        <div class="search">
          <input type="text" placeholder="探し物" aria-label="探し物を検索">
          <button aria-label="検索">🔍</button>
        </div>
        <button class="logout">ログアウト</button>
      </div>
    </div>

    <div class="content">
      <div class="breadcrumb">&lt; ホームへ</div>

      <div class="nextwrap">
        <button class="next" onclick="alert('購入手続きへ（遷移先URLを設定）')">購入手続きへ</button>
      </div>

      <div class="list">
        <?php foreach ($items as $it): ?>
          <div class="item">
            <div class="thumb" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <path d="M21 15l-5-5L5 21"/>
              </svg>
            </div>

            <div class="meta">
              <form method="post" style="float:right;margin-bottom:6px;">
                <input type="hidden" name="csrf" value="<?php echo h($csrf); ?>">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="id" value="<?php echo h($it['id']); ?>">
                <button class="remove" type="submit">削除</button>
              </form>
              <h3 class="name"><?php echo h($it['name']); ?></h3>
              <div class="price">値段（￥<?php echo number_format($it['price']); ?>）</div>
            </div>

            <div></div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="total">合計：￥<?php echo number_format($total); ?></div>
    </div>
  </div>
</body>
</html>