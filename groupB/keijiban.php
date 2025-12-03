<?php
// 1. セッションを開始
session_start();
require 'データベース.php';


// 2. ログイン状態の確認
$is_logged_in = isset($_SESSION['customer']);
$user_name = '';

if ($is_logged_in) {
    // ログインしている場合、セッションからユーザー名を取得
    $user_name = $_SESSION['customer']['name'];
}

// ★★★ 修正: header3.php の読み込みを <head> より前に記述するのをやめました ★★★
?>
<?php
    switch ($_GET['id']) {
    case 1:
        $board_id = "ゲーム";
        break; 
    case 2:
        $board_id = "アニメ";
        break;
    case 3:
        $board_id = "アイドル";
        break;
    case 4:
        $board_id = "ブランド";
        break;
    default:
        
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板フォーム</title>
    <link rel="stylesheet" href="css/keijiban.css">
    <link rel="stylesheet" href="css/header1.css">
</head>
<body>
    <?php require 'header1.php'; ?>
    <div class="breadcrumbs">
        <a href="homePage.php">ホーム</a>
        <span>></span>
        <a href="genre.php"><?php echo htmlspecialchars($board_id);?></a>
        <span>></span>
        <span class="current-page">掲示板</span>
    </div>

    <div class="main-content-wrapper">
        <?php
            // ジャンルID を安全に取得
            $genre_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

            // PDO を作成して bbs テーブルから投稿を取得
            try {
                $pdo = new PDO($connect, USER, PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);

                $stmt = $pdo->prepare('SELECT * FROM bbs WHERE genre_id = :gid ORDER BY bbs_id DESC');
                $stmt->execute([':gid' => $genre_id]);
                $posts = $stmt->fetchAll();
            } catch (Exception $e) {
                // エラー時は空リストにして表示を続行
                $posts = [];
            }
        ?>

        <form class="account-form" action="post_message.php" method="post" enctype="multipart/form-data">

            <!-- 投稿一覧（フォーム内で上に表示） -->
            <div class="posts-list">
                <?php if (empty($posts)): ?>
                    <p class="no-posts">まだ投稿がありません。</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post">
                            <div class="post-meta">
                                <span class="post-id"><?php echo htmlspecialchars($post['bbs_id']); ?></span>
                                <span class="post-date"><?php echo htmlspecialchars($post['date']); ?></span>
                            </div>
                            <div class="post-content"><?php echo nl2br(htmlspecialchars($post['post_content'])); ?></div>
                            <?php if (!empty($post['image_detail'])): ?>
                                <div class="post-image">
                                    <img src="<?php echo htmlspecialchars($post['image_detail']); ?>" alt="投稿画像" style="max-width:200px; height:auto;">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- 投稿フォーム（下に配置） -->
            <div class="image-upload-area">
                <input type="text" name="post_content" placeholder="メッセージを入力..." required>
                <input type="file" name="image_detail" accept="image/*">
                <input type="hidden" name="genre_id" value="<?php echo $genre_id; ?>">
                <?php if ($is_logged_in && isset($_SESSION['customer']['id'])): ?>
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['customer']['id']); ?>">
                <?php endif; ?>
                <button type="submit" class="icon-button send-icon">▶</button>
            </div>

        </form>
    </div>

</body>
</html>
