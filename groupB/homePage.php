<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オタクグッズフリマ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@700;900&display=swap');
    </style>
    <style>
        /* フォント設定 */
body {
    font-family: 'M PLUS Rounded 1c', sans-serif, 'Meiryo', sans-serif;
    margin: 0;
    background-color: white; /* 全体の背景色を白に変更 */
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* --- 1. ロゴバナー (画像挿入部分) --- */
.logo-banner-wrapper {
    /* バナー全体の余白と角丸を管理する外側のラッパー */
    padding: 20px; /* 全体に余白を追加 */
    background-color: white; /* 余白部分の背景色も白 */
}

.logo-banner-image {
    height: 180px; /* 画像全体が見えるように高さを調整 */
    width: 100%;
    margin: 0 auto; 
    
    background-color: #feeb42; /* バナーの背景色 */
    
    border-radius: 15px; /* 角を丸くする */
    overflow: hidden; 
    
    /* 提供された画像ファイルを背景として挿入 */
    background-image: url('image/logo_banner.png'); 
    background-size: contain; /* 画像がバナー領域内に完全に収まるようにする */
    background-position: center; /* 画像を中央に配置 */
    background-repeat: no-repeat; 
    
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* 少し影をつけて立体感を出す */
}


/* --- 2. おすすめ商品セクション --- */
.section-title {
    font-size: 1.5em;
    font-weight: bold;
    margin: 20px 0 15px 0;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 1行に5列 */
    gap: 15px;
}

.product-item {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    padding: 5px;
    box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
}

.product-image {
    background-color: #ccc; /* 画像のプレースホルダー */
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 5px;
}

.product-image::after {
    content: ''; 
    display: block;
    width: 80%;
    height: 80%;
    background-color: #aaa;
    border-radius: 5px;
}

.product-info {
    position: relative;
    padding: 5px;
    font-size: 0.9em;
}

.price {
    font-weight: bold;
    color: #333;
    display: block;
    float: left;
    font-size: 1.1em;
}

/* --- ハートアイコンのスタイル --- */
.heart-icon {
    float: right;
    font-size: 1.2em;
    cursor: pointer; 
    line-height: 1;
    color: #666; /* 初期の色はグレー */
    transition: color 0.1s; /* 色変更をスムーズに */
}

/* ホバー時のスタイル（クリックと区別するため、少し薄い色に） */
.heart-icon:hover {
    color: #aaa; 
}

/* いいねされたときのスタイル (JavaScriptで付与される) */
.heart-icon.liked {
    color: #ff5252; /* 赤色 */
    /* 塗りつぶしハート（♥）に切り替える */
    content: '♥'; 
    /* Webフォントを使用していないため、記号の切り替えはHTMLで行う方が確実ですが、ここではCSSで対応が簡単なように、HTML側に手を加えずに処理します。*/
}

.description {
    clear: both;
    font-size: 0.8em;
    color: #666;
    margin: 5px 0 0 0;
    height: 2.4em; 
    overflow: hidden;
}


/* --- 3. 掲示板セクション --- */
.board-title {
    margin-top: 40px;
}

.board-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 1行に4列 */
    gap: 20px;
    text-align: center;
}

.board-item {
    background-color: white;
    border: none; 
    border-radius: 5px;
    padding: 50px 10px;
    font-weight: bold;
    font-size: 1.1em;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
    </style>
</head>
<body>
<<<<<<< Updated upstream

    <div id="wrapper">
        <div class="logo-banner-wrapper">
            <div class="logo-banner-image"></div> 
        </div>

        <main class="container">
            <h2 class="section-title">おすすめ</h2>
            <div class="product-grid">
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">ああああああああああああああああ...</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">ああああああああああああああああ...</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-image"></div>
                    <div class="product-info">
                        <span class="price">¥ 500</span>
                        <span class="heart-icon">♡</span>
                        <p class="description">商品説明</p>
                    </div>
                </div>
            </div>

            <h2 class="section-title board-title">掲示板</h2>
            <div class="board-grid">
                <div class="board-item">ゲーム</div>
                <div class="board-item">アニメ</div>
                <div class="board-item">アイドル</div>
                <div class="board-item">ブランド</div>
            </div>
        </main>
=======
    <div name="Image.Ad">
        <img src="">
>>>>>>> Stashed changes
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // すべてのハートアイコン要素を取得
            const heartIcons = document.querySelectorAll('.heart-icon');

            heartIcons.forEach(icon => {
                icon.addEventListener('click', () => {
                    // .likedクラスの有無を切り替える (トグル)
                    icon.classList.toggle('liked');
                    
                    // クリックでアイコンの文字自体を切り替える
                    if (icon.classList.contains('liked')) {
                        icon.textContent = '♥'; // 塗りつぶしハート
                    } else {
                        icon.textContent = '♡'; // 白抜きハート
                    }
                });
            });
        });
    </script>
    </body>
</html>