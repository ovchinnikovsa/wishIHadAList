FROM php:8.2-fpm

# Аргументы с значениями по умолчанию
ARG UID=1000
ARG GID=1000

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    sudo

# Создаем группу только если GID не 0
RUN if [ "$GID" -ne 0 ]; then groupadd -g $GID appuser || true; fi

# Создаем пользователя
RUN if [ "$UID" -ne 0 ]; then \
    useradd -u $UID -g $GID -m -s /bin/bash appuser && \
    echo "appuser ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers; \
    fi

# Расширения PHP
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql pgsql mbstring exif pcntl bcmath gd zip sockets
#RUN pecl install amqp && docker-php-ext-enable amqp
RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions xdebug
#RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
#    && apk add --update linux-headers \
#    && pecl install xdebug-3.2.2 \
#    && docker-php-ext-enable xdebug \
#    && apk del -f .build-deps


# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Настройки PHP
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini

# Рабочая директория
WORKDIR /var/www

# Меняем владельца, если пользователь не root
RUN if [ "$UID" -ne 0 ]; then chown -R $UID:$GID /var/www; fi

# Переключаемся на созданного пользователя
USER ${UID}:${GID}