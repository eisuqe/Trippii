# PHP と Apache のベースイメージを使用
FROM php:8.2-apache

# 必要なパッケージをインストール (MySQL 用)
RUN apt-get update && apt-get install -y \
    libmysqlclient-dev \
    libssl-dev \
    zlib1g-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && apt-get clean

# アプリケーションコードをコンテナにコピー
COPY . /var/www/html/

# Apache の設定を更新 (必要に応じて)
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# ポート80を公開
EXPOSE 80

# Apache サーバーを起動
CMD ["apache2-foreground"]
