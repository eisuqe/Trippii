<!-- dockerfile -->
# ベースイメージを指定 (PHP + Apache)
FROM php:8.2-apache

# 必要なパッケージをインストール (PostgreSQL のドライバを含む)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean

# アプリケーションコードをコンテナにコピー
COPY . /var/www/html/

# Apache の設定を更新
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# ポート80を公開
EXPOSE 80

# Apache サーバーを起動
CMD ["apache2-foreground"]

<!-- index.php -->
<?php
ob_start(); // 出力バッファリングを開始
session_start();
$error = null; // エラー表示用

if (isset($_SESSION['login_error'])) {
    //$error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
ob_end_flush(); // 出力をフラッシュ
?>
<!-- index.php -->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trippii-Login</title>
        <link rel="stylesheet" href="./css/style.css">
        <?php include './tools/heads/head-link.php'; ?>
    </head>
    <?php include './tools/heads/header.php'; ?>
    <body>
        <div id="main">
            <!-- ログイン -->
            <div class="index-main">
                <div class="index-main-txt">
                    <p1>ログイン</p1>
                    <p>アカウントをお持ちの方はログインしてください</p>
                </div>
                <?php if ($error): ?>
                    <p style="color: red; font-size: 15px; margin-top: -20px;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <div class="index-main-form">
                    <form action="authenticate.php" method="POST">
                        <label>メールアドレス</label><br>
                        <input type="email" name="email" id="email" required><br>
                        <label>パスワード</label><br>
                        <input type="password" name="password" id="password" required><br>
                        <div class="index-main-form-buttom">
                            <button type="submit">ログイン</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- 新規 -->
            <div class="index-main-1">
                <div class="index-main-txt">
                    <p1>会員登録</p1>
                    <p>会員になると作成した旅のしおりを保存できます</p>
                </div>
                <div class="index-main-form-1">
                    <a href="./new-user.php">
                        <button>今すぐ新規作成</button> 
                    </a>
                </div>
            </div>
        </div>  
        <?php include './tools/footer/footer.php'?>
    </body>
</html>

<!-- db.php -->
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

    echo "データベース接続成功！";
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
<!-- authenticate.php -->
<?php
require './tools/db/db.php';
session_start();

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;


// POSTリクエストの確認
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    // 入力が空の場合のチェック
    if (!$email || !$password) {
        $_SESSION['login_error'] = 'メールアドレスまたはパスワードが未入力です。';
        header('Location: index.php');
        exit;
    }

    try {
        // データベースからユーザー情報を取得
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // ユーザーが存在し、パスワードが正しい場合
        if ($user && password_verify($password, $user['password'])) {
            // セッションに情報を保存
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: home.php'); // ログイン成功後にhome.phpへリダイレクト
            exit;
        } else {
            // ログイン失敗時
            $_SESSION['login_error'] = 'メールアドレスまたはパスワードが間違っています。';
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
