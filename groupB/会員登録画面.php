<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>新規会員登録</title>
<style>

  .container {
    width: 400px;
    background-color: #f2f2f2;
    margin: 40px auto;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    padding: 20px 30px;
  }

  h2 {
    text-align: center;
    margin-bottom: 10px;
    color: #333;
  }

  .error {
    color: red;
    font-size: 13px;
    text-align: center;
    margin-bottom: 10px;
  }

  label {
    display: block;
    font-size: 14px;
    margin-top: 10px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="tel"] {
    width: 100%;
    padding: 8px;
    margin-top: 3px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .required {
    color: red;
    font-size: 13px;
  }

  .note {
    font-size: 12px;
    color: #666;
  }

  .btn {
    display: block;
    width: 100%;
    background-color: red;
    color: white;
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    margin-top: 20px;
    cursor: pointer;
  }

  .btn:hover {
    background-color: #cc0000;
  }

  .login-link {
    text-align: center;
    font-size: 13px;
    margin-top: 15px;
  }

  .login-link a {
    color: blue;
    text-decoration: none;
  }

  .login-link a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<div class="container">
  <h2>新規会員登録</h2>

  <div class="error">
    ※エラーメッセージがここに表示されます
  </div>

  <form action="会員登録完了画面.php" method="post">
    <label>メールアドレス <span class="required">必須</span></label>
    <input type="email" name="email" required>

    <label>パスワード <span class="required">必須</span></label>
    <input type="password" name="password" required>
    <p class="note">ログイン時に使用するためのものです</p>

    <label>アカウント名 <span class="required">必須</span></label>
    <input type="text" name="name" required>
    <p class="note">他の会員に表示されます</p>

    <label>郵便番号 <span class="required">必須</span></label>
    <input type="text" name="zipcode" placeholder="例）123-0000" maxlength="8" autocomplete="postal-code" required>

    <button type="submit" class="btn">登録</button>
  </form>

  <div class="login-link">
    既に登録済み（ログイン）の方は <a href="login.php">こちら</a>
  </div>
</div>

</body>
</html>
