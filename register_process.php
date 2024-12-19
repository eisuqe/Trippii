<?php
require './tools/db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // メールアドレスの重複確認
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // メールアドレスが既に存在する場合
        $_SESSION['register_error'] = "このメールアドレスは既に登録されています。";
        header('Location: new-user.php');
        exit;
    }

    // パスワードをハッシュ化
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 新規ユーザーをデータベースに追加
    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    try {
        $stmt->execute([
            'email' => $email,
            'password' => $hashed_password,
        ]);

        // 登録したユーザーを自動ログイン
        $user_id = $pdo->lastInsertId();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;

        // home.php にリダイレクト
        header('Location: home.php');
        exit;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}
?>
