<?php
session_start();

// 未ログインの場合はindex.phpにリダイレクト
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trippii-Home</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php include './tools/heads/head-link.php'; ?>
</head>
<?php include './tools/heads/header.php'; ?>
<body>
    <div id="main">
        <div class="home-main">
            <!-- 新規作成のセクション -->
            <div class="new-trip">
                <a href="shop.php" class="new-trip-icon">
                    <div class="new-trip-img">+</div>
                </a>
                <a class="new-trip-text">新規作成</a>
            </div>

            <!-- 既存の旅行リスト表示 -->
            <?php
            for ($i = 0; $i < 10; $i++) {
                include 'trip-list.php';                        
            }
            ?>
        </div>
    </div>  
    <?php include './tools/footer/footer.php' ?>
</body>
</html>
