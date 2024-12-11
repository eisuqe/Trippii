<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // 未ログインならログインページへリダイレクト
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ダッシュボード</title>
</head>
<body>
    <h1>ようこそ！</h1>
    <p>メールアドレス: <?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="logout.php">ログアウト</a>
</body>
</html>
