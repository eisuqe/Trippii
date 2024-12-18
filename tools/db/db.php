<?php
// データベース接続設定
try {
    $dsn = "mysql:host=dbtrippii.cdmms6ic0jg5.us-west-2.rds.amazonaws.com;port=3306;dbname=trippii;";
    $username = "root"; // AWS RDS MySQLのユーザー名
    $password = "eaglerock70"; // AWS RDS MySQLのパスワード

    // PDOインスタンス作成
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
