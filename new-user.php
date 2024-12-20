<?php
session_start();
$error = null;

// 登録失敗時にエラーメッセージを取得
if (isset($_SESSION['register_error'])) {
    $error = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trippii-NewUser</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php include './tools/heads/head-link.php'; ?>
</head>
<?php include './tools/heads/header.php'; ?>
<body>
    <div id="main">
        <div class="new-user-main">
            <div class="new-user-main-txt">
                <p1>新規会員登録</p1>
            </div>
            <div class="new-user-main-form">
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <form action="register_process.php" method="POST">
                    <label for="uname">UserName</label><br>
                    <input type="text" name="uname" id="uname" required>
                    <br>
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password" required>
                    <br>
                    <div class="new-user-main-form-button">
                        <button type="submit">登録してはじめる</button>
                    </div>
                </form>
                <a href="./index.php">アカウントをお持ちの方はこちら</a>
            </div>
        </div>
    </div>  
    <?php include './tools/footer/footer.php'?>
</body>
</html>
