<?php 
// homePage.php側で session_start() されている前提

// ログイン状態をチェック
$is_logged_in = isset($_SESSION['customer']);
$display_name = $is_logged_in ? htmlspecialchars($_SESSION['customer']['name']) : '';
$button_link = 'logout.php'; // ログアウトボタンは logout.php を指す
?>

<nav>
    <div class="top-row">
        <div class="logo-area">
            <img src="image/アイコン1.png" alt="アイコン">
            <span>オタグッズ</span>
            <input type="search" placeholder="探し物" name="search">
        </div>
    </div>

    <div class="bottom-row">
        <div class="navbar">
            <ul class="nav-left">
                <li><a href="homePage.php">ホーム</a></li>
                <li><a href="#">ゲーム</a></li>
                <li><a href="#">アニメ</a></li>
                <li><a href="#">アイドル</a></li>
                <li><a href="#">ブランド</a></li>
                <li><button class="sell-button">出品</button></li>
            </ul>
        </div>
        
        <div class="right-items">
            <?php if ($is_logged_in): ?>
                <span class="user-name-display"><?php echo $display_name; ?>さん</span>
                
                <div class="image">
                    <a href="#">
                        <img src="image/image.png" >
                    </a>
                </div>
                
                <div class="maindiv">
                    <a href="<?php echo $button_link; ?>">
                        <button class="button">ログアウト</button>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>