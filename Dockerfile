FROM php:8.1-apache

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Apacheの設定
COPY ./your-site.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# 必要なPHP拡張をインストール
RUN docker-php-ext-install pdo pdo_pgsql

# その他の設定（必要に応じて）
# COPY ./index.php /var/www/html/index.php

# ポート80でリッスン
EXPOSE 80

# Apacheサーバーを起動
CMD ["apache2-foreground"]

