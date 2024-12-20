<?php
session_start(); // セッション開始を一番上に移動
require './tools/db/db.php'; // DB接続ファイル

$uname = $_POST['uname'] ?? null;
$password = $_POST['password'] ?? null;

// POSTリクエストの確認
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'] ?? null;
    $password = $_POST['password'] ?? null;

    // 入力が空の場合のチェック
    if (!$uname || !$password) {
        $_SESSION['login_error'] = 'ユーザー名またはパスワードが未入力です。';
        header('Location: index.php');
        exit;
    }

    try {
        // データベースからユーザー情報を取得
        $stmt = $pdo->prepare("SELECT * FROM users WHERE uname = :uname");
        $stmt->execute(['uname' => $uname]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在し、パスワードが正しい場合
        if ($user && password_verify($password, $user['password'])) {
            // セッションに情報を保存
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['uname'] = $user['uname'];
            header('Location: home.php'); // ログイン成功後にhome.phpへリダイレクト
            exit;
        } else {
            // ログイン失敗時
            $_SESSION['login_error'] = 'ユーザー名またはパスワードが間違っています。';
            header('Location: index.php');
            exit;
        }
    } catch (PDOException $e) {
        // データベースエラー時
        die("データベースエラー: " . $e->getMessage());
    }
} else {
    // POST以外のアクセスはindex.phpへリダイレクト
    header('Location: index.php');
    exit;
}
?>
