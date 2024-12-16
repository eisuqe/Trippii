<!-- index.php -->
<?php
ob_start(); // 出力バッファリングを開始
session_start();
$error = null; // エラー表示用

if (isset($_SESSION['login_error'])) {
    //$error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
ob_end_flush(); // 出力をフラッシュ
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
            <!-- ログイン -->
            <div class="index-main">
                <div class="index-main-txt">
                    <p1>Ma-ah!</p1>
                    <p>Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!</p>
                </div>
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px; margin-top: -20px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <div class="index-main-form">
                    <form action="authenticate.php" method="POST">
                        <label>e-Mail</label><br>
                        <input type="email" name="email" id="email" required><br>
                        <label>password</label><br>
                        <input type="password" name="password" id="password" required><br>
                        <div class="index-main-form-buttom">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- 新規 -->
            <div class="index-main-1">
                <div class="index-main-txt">
                    <p1>Ma-ah!</p1>
                    <p>Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!</p>
                </div>
                <div class="index-main-form-1">
                    <a href="./new-user.php">
                        <button>Create your acount</button> 
                    </a>
                </div>
            </div>
        </div>  
        <?php include './tools/footer/footer.php'?>
    </body>
</html>

