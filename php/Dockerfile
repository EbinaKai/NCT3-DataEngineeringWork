FROM php:7.4.22-apache

RUN rm /etc/apt/preferences.d/no-debian-php

# Install git
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git net-tools vim \
    zip unzip libzip-dev && \
    apt-get clean

# Set apache mod_rewrite
RUN a2enmod rewrite

# Install php extension
RUN docker-php-ext-install mysqli pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install NPM & node
RUN curl -sl https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs build-essential
