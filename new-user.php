<!-- new-user.php -->
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
    <title>tranner</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php include './tools/heads/head-link.php'; ?>
</head>
<?php include './tools/heads/header.php'; ?>
<body>
    <div id="main">
        <div class="new-user-main">
            <div class="new-user-main-txt">
                <p1>新規会員登録</p1>
                <p>Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!</p>
            </div>
            <div class="new-user-main-form">
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <form action="register_process.php" method="POST">
                    <label for="email">e-Mail</label><br>
                    <input type="email" name="email" id="email" required>
                    <br>
                    <label for="password">password</label><br>
                    <input type="password" name="password" id="password" required>
                    <br>
                    <div class="new-user-main-form-button">
                        <button type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    <?php include './tools/footer/footer.php'?>
</body>
</html>
