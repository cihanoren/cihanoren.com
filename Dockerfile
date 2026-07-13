# Stage 1: Build frontend assets
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 2: Install PHP dependencies
FROM composer:2 AS composer-builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction
COPY . .
RUN composer dump-autoload --optimize

# Stage 3: Final image
FROM webdevops/php-nginx:8.2-alpine

ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISPLAY_ERRORS=0

WORKDIR /app

COPY --from=composer-builder /app /app
COPY --from=node-builder /app/public/build /app/public/build

# storage/app/public dizinini garanti et ve public/storage symlink'ini
# build zamanında doğru relative path ile oluştur (her image build'inde kalıcı)
RUN mkdir -p /app/storage/app/public \
    && rm -rf /app/public/storage \
    && ln -s ../storage/app/public /app/public/storage

RUN chown -R application:application /app/storage /app/bootstrap/cache /app/public/storage \
    && chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 80
