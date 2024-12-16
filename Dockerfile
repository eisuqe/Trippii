# ベースイメージを指定 (PHP + Apache)
FROM php:8.2-apache

# 必要なPHP拡張モジュールをインストール
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# アプリケーションコードをコンテナにコピー
COPY . /var/www/html

# Apacheの設定を更新 (必要に応じて)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# ポート80を公開
EXPOSE 80

# Apacheサーバーを起動
CMD ["apache2-foreground"]