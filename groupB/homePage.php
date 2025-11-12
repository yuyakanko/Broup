<?php require 'header3.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オタクグッズフリマ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="homePage.css">
</head>
<body>

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