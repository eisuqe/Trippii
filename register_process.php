<?php
require './tools/db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    // ユーザー名の重複確認
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE uname = :uname");
    $stmt->execute(['uname' => $uname]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // ユーザー名が既に存在する場合
        $_SESSION['register_error'] = "このユーザー名は既に登録されています。";
        header('Location: new-user.php');
        exit;
    }

    // パスワードをハッシュ化
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 新規ユーザーをデータベースに追加
    $stmt = $pdo->prepare("INSERT INTO users (uname, password) VALUES (:uname, :password)");
    try {
        $stmt->execute([
            'uname' => $uname,
            'password' => $hashed_password,
        ]);

        // 登録したユーザーを自動ログイン
        $user_id = $pdo->lastInsertId();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['uname'] = $uname;

        // home.php にリダイレクト
        header('Location: home.php');
        exit;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>
