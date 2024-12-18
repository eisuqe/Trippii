# PHPとApacheのベースイメージを使用
FROM php:8.2-apache

# 必要なPHP拡張をインストール (MySQL接続用)
RUN apt-get update && apt-get install -y libmysqlclient-dev && \
    docker-php-ext-install pdo pdo_mysql

# アプリケーションコードをコンテナにコピー
COPY . /var/www/html

# Apacheの設定を調整
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# ポート80を公開
EXPOSE 80

# Apacheサーバーを起動
CMD ["apache2-foreground"]
