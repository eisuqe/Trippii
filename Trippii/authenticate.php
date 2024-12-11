<!-- auhtenticate.php -->
<?php
require './tools/db/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // データベースからユーザー情報を取得
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // ログイン成功
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: home.php'); // home.php にリダイレクト
        exit;
    } else {
        // ログイン失敗
        $_SESSION['login_error'] = "メールアドレスまたはパスワードが間違っています。";
        header('Location: index.php'); // エラーメッセージを表示するため index.php にリダイレクト
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        die('入力が不完全です。');
    }

    // データベースからユーザーを取得
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die('メールアドレスが見つかりません。');
    }

    // デバッグ: DBから取得したパスワードを確認
    echo "DBに保存されているハッシュ: " . htmlspecialchars($user['password']) . "<br>";
    echo "入力されたパスワード: " . htmlspecialchars($password) . "<br>";

    // パスワード検証
    if (password_verify($password, $user['password'])) {
        echo "パスワードが一致しました！";
        // ここでセッション設定とリダイレクト
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: home.php');
        exit;
    } else {
        die('パスワードが一致しません。');
    }
}

?>
