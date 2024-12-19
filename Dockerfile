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
