<?php
// データベース接続設定
try {
    // PostgreSQL の接続情報を設定
    $host = 'dpg-ctdofcaj1k6c73ds3pdg-a.singapore-postgres.render.com';
    $port = '5432';
    $dbname = 'db_trippii';
    $username = 'root';
    $password = '6vyi646onyQuRuxiQvgVm8DZDzjPI64e';
    $sslmode = 'require'; // SSL接続を有効化

    // DSN (データソース名) を作成
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=$sslmode";

    // PDO インスタンス作成
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
