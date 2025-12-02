<?php session_start();?>
<?php require 'データベース.php'; ?>
<?php
    $error_message = '';

    // 入力チェック（例）
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_message = '*エラーメッセージ';
    }
    elseif(empty($_POST['account_name'])) {
        $error_message = '*エラーメッセージ';
    }
    elseif(!is_numeric($_POST['postal_code'])) {
        $error_message = '*エラーメッセージ';
    }
    else if(strlen($_POST['account_name'] > 30)){
        $error_message = '*エラーメッセージ';
    }
    else if(strlen($_POST['password'] > 255)){
        $error_message = '*エラーメッセージ';
    }
    else if(strlen($_POST['email'] > 254)){
        $error_message = '*エラーメッセージ';
    }


    // エラーがあればセッションに保存して元の画面に戻す
    if($error_message !== '') {
        $_SESSION['error_message'] = $error_message;
        header('Location: プロフィール.php');
        exit;
    }

    // エラーがなければ更新処理へ進む
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['account_name']) && isset($_POST['postal_code']) && isset($_SESSION['customer'])){
        $pdo=new PDO($connect, USER, PASS);
        if($_POST['account_name'] != $_SESSION['customer']['name']){
            $sql = $pdo->prepare("UPDATE user SET account_name = ? WHERE user_id = ?");
            $sql->execute([$_POST['account_name'],$_SESSION['customer']['id']]);
            $_SESSION['customer']['name'] = $_POST['account_name'];
        }
        if($_POST['password'] != $_SESSION['customer']['password']){
            $hqs = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = $pdo->prepare("UPDATE user SET password = ? WHERE user_id = ?");
            $sql->execute([$hqs,$_SESSION['customer']['id']]);
            $_SESSION['customer']['password'] = $_POST['password'];
        }
        if($_POST['email'] != $_SESSION['customer']['email']){
            $sql = $pdo->prepare("UPDATE user SET user_mail = ? WHERE user_id = ?");
            $sql->execute([$_POST['email'],$_SESSION['customer']['id']]);
            $_SESSION['customer']['email'] = $_POST['email'];
        }
        if($_POST['postal_code'] != $_SESSION['customer']['zipcode']){
            $sql = $pdo->prepare("UPDATE user SET postal_code = ? WHERE user_id = ?");
            $sql->execute([$_POST['postal_code'],$_SESSION['customer']['id']]);
            $_SESSION['customer']['zipcode'] = $_POST['postal_code'];
        }
        header('Location: プロフィール.php');
    }


    // セッションにエラーメッセージがあれば表示
    if(isset($_SESSION['error_message'])) {
        $error_message = $_SESSION['error_message'];
        unset($_SESSION['error_message']);
    }
?>