FROM php:8.1.13-apache-bullseye
ARG TARGETARCH
RUN apt update \
    && apt install -y perl libcgi-pm-perl \
          msmtp msmtp-mta \
          imgp \
    && a2enmod cgi \
    && a2enmod actions \
    && a2enmod headers \
    && a2enmod proxy \
    && a2enmod proxy_http \
    && a2enmod proxy_connect \
    && a2enmod proxy_wstunnel \
    && a2disconf docker-php.conf \
    && docker-php-ext-install pdo_mysql \
    && mkdir -p /usr/local/libxml2.7.8/ \
    && mkdir -p /etc/php/5.3/cgi/

# 以下はデバッグ用ツールのインストール（本番では必要なし）
# RUN apt install -y vim-tiny less iputils-ping net-tools
# デバッグ用終わり

# apacheの設定ファイル
ADD  apache2.tar.gz /etc/apache2/

# msmtp 系の設定
COPY msmtprc /etc/

# php.iniとCGI用シェルスクリプト
COPY php.ini /etc/php/5.3/cgi/
COPY php.ini /usr/local/etc/php/
COPY php-5.3.3 /usr/lib/cgi-bin/

# アーキテクチャに応じて PHPバイナリをコピー
ADD  php-5.3.3.bin-${TARGETARCH}.tar.gz /usr/local/bin/
# アーキテクチャに応じて libxml2 をコピー
WORKDIR /usr/local/libxml2.7.8/lib
COPY libxml2.so.2.7.8-${TARGETARCH} libxml2.so.2.7.8
# 諸々の設定
RUN ln -s libxml2.so.2.7.8 libxml2.so.2 \
    && ln -s libxml2.so.2.7.8 libxml2.so \
    && chmod +x /usr/lib/cgi-bin/php-5.3.3

# コンテンツの設置
ADD  var-upload.tar.gz /var/
ADD  www.tar.gz /var/www/

WORKDIR /var/www/html
CMD ["apache2-foreground"]
