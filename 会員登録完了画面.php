<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>会員登録完了 | グッズフリマ</title>
  <style>
    :root{
      --bg:#2b2b2b;              /* 背景（スクショの暗いトーン想定） */
      --card:#ffffff;            /* カード */
      --text:#6b7280;            /* 薄いグレーの本文 */
      --brand:#fff68a;           /* 上部の薄いイエロー */
      --btn:#e60012;             /* 赤ボタン */
      --btn-hover:#c80010;       /* ホバー時 */
      --radius:4px;
      --shadow:0 8px 18px rgba(0,0,0,.18);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Noto Sans JP","Hiragino Kaku Gothic ProN","Yu Gothic","YuGothic","Helvetica Neue",Arial,sans-serif;
      background: var(--bg);
      display:grid; place-items:center;
      padding:24px;
    }

    .frame{ width: 660px; max-width: calc(100vw - 40px); background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); }
    .brandbar{ height: 40px; background: var(--brand); display:flex; align-items:center; gap:10px; padding:0 12px; border-top-left-radius:var(--radius); border-top-right-radius:var(--radius); }
    .brandbar .logo{ width:18px; height:18px; border-radius:4px; background:#ff9bd4; display:grid; place-items:center; font-size:12px; color:#fff; }
    .brandbar .name{ font-size:13px; color:#333; }

    .body{ padding: 56px 40px 64px; text-align:center; }
    .title{ font-size:22px; color:#8a8f98; margin:0 0 14px; letter-spacing:.02em; }
    .subtitle{ font-size:18px; color:#8a8f98; margin:0 0 26px; letter-spacing:.02em; }

    .btn{ appearance:none; border:0; background:var(--btn); color:#fff; font-weight:700; padding:10px 18px; border-radius:999px; cursor:pointer; box-shadow:0 2px 0 rgba(0,0,0,.15); }
    .btn:hover{ background:var(--btn-hover); }
    .btn:active{ transform: translateY(1px); box-shadow:none; }

    @media (max-width:480px){
      .body{ padding: 44px 18px 54px; }
      .title{ font-size:20px; }
      .subtitle{ font-size:16px; }
    }
  </style>
</head>
<body>
  <main class="frame" role="region" aria-label="会員登録完了">
    <div class="brandbar">
      <div class="logo" aria-hidden="true">♪</div>
      <div class="name">オタグッズ</div>
    </div>
    <div class="body">
      <p class="title">会員登録が完了しました</p>
      <p class="subtitle">グッズフリマへようこそ！</p>
      <button class="btn" id="homeBtn" type="button">ホームへ</button>
    </div>
  </main>

  <script>
    // 実装先のURLに置き換え
    document.getElementById('homeBtn').addEventListener('click', () => {
      // location.href = '/';
      alert('ホームへ遷移（ここにURLを設定）');
    });
  </script>
</body>
</html>
