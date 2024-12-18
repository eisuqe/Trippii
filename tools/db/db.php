<?php
// データベース接続設定
try {
    // sslmode=prefer を使用してみる
    $dsn = "mysql:host=dbtrippii.cdmms6ic0jg5.us-west-2.rds.amazonaws.com;port=3306;dbname=trippii;user=root;password=eaglerock70;";
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
