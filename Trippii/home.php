<!-- home.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // 未ログイン時はログイン画面へ
    exit;
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
        <div class="home-main">
            <div class="new-trip">
                <a href="shop.php" class="new-trip-icon">
                    <div class="new-trip-img">+</div>
                </a>
                <a class="new-trip-text">add a new trip</a>
            </div>
            <?php
            for ($i = 0; $i < 10; $i++) {
                include 'trip-list.php';                        
            }
            ?>
        </div>
    </div>  
    <?php include './tools/footer/footer.php'?>
</body>
</html>
