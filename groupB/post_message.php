<?php
session_start();
require 'データベース.php';

// POST チェック
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: keijiban.php');
	exit;
}

// 入力を取得
$post_content = isset($_POST['post_content']) ? trim($_POST['post_content']) : '';
$genre_id = isset($_POST['genre_id']) && is_numeric($_POST['genre_id']) ? intval($_POST['genre_id']) : 0;
$user_id = null;
if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
	$user_id = intval($_POST['user_id']);
} elseif (isset($_SESSION['customer']['id'])) {
	$user_id = intval($_SESSION['customer']['id']);
}

// 簡単なバリデーション
if ($post_content === '') {
	echo "投稿内容を入力してください。<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
	exit;
}

// 画像保存処理（任意）
$image_path = '';
if (isset($_FILES['image_detail']) && $_FILES['image_detail']['error'] !== UPLOAD_ERR_NO_FILE) {
	$file = $_FILES['image_detail'];
	if ($file['error'] === UPLOAD_ERR_OK) {
		// サイズチェック（5MB 制限）
		if ($file['size'] > 5 * 1024 * 1024) {
			echo "画像が大きすぎます（5MB まで）。<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
			exit;
		}

		// 画像判定
		$imginfo = @getimagesize($file['tmp_name']);
		if ($imginfo === false) {
			echo "画像ファイルではありません。<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
			exit;
		}

		// 拡張子判定
		$mime = $imginfo['mime'];
		$ext = '';
		switch ($mime) {
			case 'image/jpeg': $ext = 'jpg'; break;
			case 'image/png':  $ext = 'png'; break;
			case 'image/gif':  $ext = 'gif'; break;
			default:
				echo "対応していない画像形式です。<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
				exit;
		}

		// 保存先ディレクトリ
		$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'image';
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}

		// 一意なファイル名
		$filename = uniqid('img_') . '.' . $ext;
		$destination = $uploadDir . DIRECTORY_SEPARATOR . $filename;

		if (!move_uploaded_file($file['tmp_name'], $destination)) {
			echo "画像の保存に失敗しました。<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
			exit;
		}

		// Web から参照するパス（相対パス）
		$image_path = 'image/' . $filename;
	} else {
		echo "画像アップロードエラー: " . intval($file['error']) . "<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
		exit;
	}
}

// DB に登録
try {
	$pdo = new PDO($connect, USER, PASS, [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);

	$sql = 'INSERT INTO bbs (post_content, date, image_detail, genre_id, user_id) VALUES (:content, :date, :image, :gid, :uid)';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		':content' => $post_content,
		':date' => date('Y-m-d'),
		':image' => $image_path,
		':gid' => $genre_id,
		':uid' => $user_id,
	]);

	// 登録完了後、掲示板へ戻す
	header('Location: keijiban.php?id=' . $genre_id);
	exit;
} catch (Exception $e) {
	echo "データベースエラー: " . htmlspecialchars($e->getMessage()) . "<br><a href=\"keijiban.php?id={$genre_id}\">戻る</a>";
	exit;
}


