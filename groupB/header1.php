<?php 
// homePage.php側で session_start() されている前提

// ログイン状態をチェック
$is_logged_in = isset($_SESSION['customer']);
$display_name = $is_logged_in ? htmlspecialchars($_SESSION['customer']['name']) : '';
$button_link = 'logout.php'; // ログアウトボタンは logout.php を指す
?>


<nav>
    <div class="new-row">
		<div class="logo-and-search">
        	<div class="logo-area">
        		<img src="image/アイコン1.png" alt="アイコン">
        		<span>オタグッズ</span>
    		</div>
        	<div class="serach-area">
				<form action="product_search.php" method="POST">
        			<input type="search" placeholder="探し物" name="search">
				</form>
    		</div>
    	</div>
        <div class="right-items">
       		<?php if ($is_logged_in): ?>
            <div class="image">
        		<a href="プロフィール.php">
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