<?php
// データベース接続設定
try {
    $dsn = "postgresql://root:6vyi646onyQuRuxiQvgVm8DZDzjPI64e@dpg-ctdofcaj1k6c73ds3pdg-a/db_trippii";
    $username = "root"; // AWS RDS MySQLのユーザー名
    $password = "6vyi646onyQuRuxiQvgVm8DZDzjPI64e"; // AWS RDS MySQLのパスワード

    // PDOインスタンス作成
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
