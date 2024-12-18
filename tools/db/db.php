<?php
// データベース接続設定
try {
$dsn = "mysql:host=dbtrippii.cdmms6ic0jg5.us-west-2.rds.amazonaws.com;port=3306;dbname=trippii;charset=utf8mb4;";
$options = [
    PDO::MYSQL_ATTR_SSL_CA => '/path/to/aws/rds-combined-ca-bundle.pem',
];
$pdo = new PDO($dsn, 'root', 'eaglerock70', $options);


    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
