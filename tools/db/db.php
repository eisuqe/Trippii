<?php
// データベース接続設定
try {
    // SSL接続を有効にするためにsslmode=requireを追加
    $dsn = "pgsql:host=dpg-ctdofcaj1k6c73ds3pdg-a.singapore-postgres.render.com;port=5432;dbname=db_trippii;user=root;password=6vyi646onyQuRuxiQvgVm8DZDzjPI64e;sslmode=require";
    $pdo = new PDO($dsn); // $user と $password は不要
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
