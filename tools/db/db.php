<?php
// データベース接続設定
try {
    $dsn = "pgsql:host=dpg-ctdofcaj1k6c73ds3pdg-a.singapore-postgres.render.com;port=5432;dbname=db_trippii;user=root;password=6vyi646onyQuRuxiQvgVm8DZDzjPI64e";
    $pdo = new PDO($dsn); // $user と $password は不要
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}

// ユーザーデータ挿入
try {
    // SQLクエリの準備
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => 'e@e',
        ':password' => password_hash('mypassword', PASSWORD_DEFAULT)
    ]);
        
    // SQLを実行
    $stmt->execute([
        ':email' => $email,
        ':password' => $password
    ]);

    echo "データが正常に挿入されました！";
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>
