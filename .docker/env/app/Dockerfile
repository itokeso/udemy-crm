FROM php:8.1.13-fpm-bullseye
COPY ./php.ini /usr/local/etc/php/

# Install extensions for php.
RUN apt-get update -y && \
    apt-get install -y vim \
                       iputils-ping \
                       net-tools && \
    apt-get install -y git \
                       openssl \
                       libtool \
                       automake \
                       build-essential \
                       zip && \
    apt-get install -y libpng-dev \
                       libjpeg-dev \
                       libpq-dev \
                       libmcrypt-dev \
                       libldap2-dev \
                       libldb-dev \
                       libicu-dev \
                       libgmp-dev \
                       libxml2-dev \
                       libwebp-dev \
                       libopenjp2-7-dev \
                       librsvg2-dev \
                       libde265-dev  \
                       libzip-dev \
                       libonig-dev && \
    ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so && \
    ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so && \
    ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd \
                           mysqli \
                           opcache \
                           pdo \
                           pdo_mysql \
                           pdo_pgsql \
                           pgsql \
                           ldap \
                           intl \
                           gmp \
                           zip \
                           bcmath \
                           soap \
                           pcntl && \
    rm -rf /var/lib/apt/lists/*

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install composer.
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install nodejs
RUN rm -rf /var/lib/apt/lists/*
RUN rm -rf /etc/apt/sources.list.d/*

RUN apt-get install curl
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

WORKDIR /var/www/html