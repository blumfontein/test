FROM ubuntu:focal
ENV TZ 'UTC'

RUN set -x \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && apt-get update \
    && apt-get install -y \
        ca-certificates \
        wget \
        locales \
        gnupg2 \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu focal main" > /etc/apt/sources.list.d/php.list \
    && echo "deb-src http://ppa.launchpad.net/ondrej/php/ubuntu focal main" >> /etc/apt/sources.list.d/php.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys ABF5BD827BD9BF62 \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C \
    && apt update \
    && apt install -y \
        php8.3 \
        php8.3-cli \
        php8.3-common \
        php8.3-curl \
        php8.3-pgsql \
        php8.3-fpm \
        php8.3-opcache \
        php8.3-xml \
        php8.3-mbstring \
        curl \
        zip \
        apt-transport-https \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/symfony
COPY . /var/www/symfony

RUN php composer.phar install --no-interaction --optimize-autoloader --prefer-dist

ENTRYPOINT ["/var/www/symfony/run.sh"]
