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
       		<div class="image">
           		<img src="image/image.png">
           	</div>
        	<div class="maindiv">
           		<form action="<?php echo $button_link; ?>" method="POST">
           			<button class="button">ログアウト</button>
           		</form>
        	</div>
    	</div>
    </div>
</nav>