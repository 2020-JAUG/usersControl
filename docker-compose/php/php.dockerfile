FROM php:8.2-fpm

ARG user
ARG uid

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -qy \
    git \
    curl \
    zip \
    libmcrypt-dev \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libxrender1 \
    libfontconfig1 \
    libonig-dev \
    libwebp-dev \
    libjpeg-dev \
    libpng-dev \
    libxpm-dev \
    libgd-dev \
    --no-install-recommends && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install -j$(nproc) pdo_mysql gd pcntl exif ctype bcmath zip
RUN docker-php-ext-enable zip
RUN pecl install redis && docker-php-ext-enable redis

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www
