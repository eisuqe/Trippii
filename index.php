<?php
session_start();
$error = null; // エラー表示用

if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trippii-Login</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php include './tools/heads/head-link.php'; ?>
</head>
<body>
    <?php include './tools/heads/header.php'; ?>
    <div id="main">
        <!-- ログイン -->
        <div class="index-main">
            <div class="index-main-txt">
                <p1>ログイン</p1>
            </div>
            <div class="index-main-form">
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px; margin-top: -20px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <form action="authenticate.php" method="POST">
                    <label>UserName</label><br>
                    <input type="text" name="uname" id="uname" required><br>
                    <label>Password</label><br>
                    <input type="password" name="password" id="password" required><br>
                    <div class="index-main-form-button">
                        <button type="submit">ログイン</button>
                    </div>
                </form>
                <a href="./new-user.php">新しくアカウントを作成する</a>
            </div>
        </div>
    </div>  
    <?php include './tools/footer/footer.php'; ?>
</body>
</html>
