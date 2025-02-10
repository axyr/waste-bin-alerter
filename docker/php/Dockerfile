ARG IMAGE_PLATFORM=linux/amd64

FROM --platform=${IMAGE_PLATFORM} ghcr.io/axyr/laravel-docker-base-image:latest

WORKDIR "/app"

COPY ../../. /app

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader
