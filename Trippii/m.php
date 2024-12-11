<!-- index.php -->
<?php
session_start();
$error = null; // エラー表示用

// ログイン失敗時にエラーメッセージを取得
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>tranner</title>
        <link rel="stylesheet" href="./css/style.css">
        <?php include './tools/heads/head-link.php'; ?>
    </head>
    <?php include './tools/heads/header.php'; ?>
    <body>
        <div id="main">
            <!-- ログイン -->
            <div class="index-main">
                <div class="index-main-txt">
                    <p1>Ma-ah!</p1>
                    <p>Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!</p>
                </div>
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px; margin-top: -20px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <div class="index-main-form">
                    <form action="authenticate.php" method="POST">
                        <label>e-Mail</label><br>
                        <input type="email" name="email" id="email" required><br>
                        <label>password</label><br>
                        <input type="password" name="password" id="password" required><br>
                        <div class="index-main-form-buttom">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- 新規 -->
            <div class="index-main-1">
                <div class="index-main-txt">
                    <p1>Ma-ah!</p1>
                    <p>Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!</p>
                </div>
                <div class="index-main-form-1">
                    <a href="./new-user.php">
                        <button>Create your acount</button> 
                    </a>
                </div>
            </div>
        </div>  
        <?php include './tools/footer/footer.php'?>
    </body>
</html>

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
<!-- new-user.php -->
<?php
session_start();
$error = null;

// 登録失敗時にエラーメッセージを取得
if (isset($_SESSION['register_error'])) {
    $error = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tranner</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php include './tools/heads/head-link.php'; ?>
</head>
<?php include './tools/heads/header.php'; ?>
<body>
    <div id="main">
        <div class="new-user-main">
            <div class="new-user-main-txt">
                <p1>新規会員登録</p1>
                <p>Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!Ma-ah!</p>
            </div>
            <div class="new-user-main-form">
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <form action="register_process.php" method="POST">
                    <label for="email">e-Mail</label><br>
                    <input type="email" name="email" id="email" required>
                    <br>
                    <label for="password">password</label><br>
                    <input type="password" name="password" id="password" required>
                    <br>
                    <div class="new-user-main-form-button">
                        <button type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    <?php include './tools/footer/footer.php'?>
</body>
</html>
