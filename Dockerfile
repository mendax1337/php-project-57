FROM php:8.2-cli

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        libpq-dev \
        libzip-dev \
        unzip \
    ; \
    docker-php-ext-install -j"$(nproc)" bcmath pdo pdo_pgsql zip; \
    php -r "copy('https://getcomposer.org/installer','/tmp/composer-setup.php');"; \
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer; \
    rm -f /tmp/composer-setup.php; \
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -; \
    apt-get update; \
    apt-get install -y --no-install-recommends nodejs; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

ENV APP_ENV=production \
    NODE_ENV=production \
    NPM_CONFIG_PRODUCTION=false

WORKDIR /app
COPY . .

RUN set -eux; \
    composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader; \
    npm ci --no-audit --no-fund; \
    npm run build; \
    test -f public/build/manifest.json \
      && echo "=== manifest.json (first 300 bytes) ===" \
      && head -c 300 public/build/manifest.json \
      || (echo "manifest.json NOT FOUND" && exit 1); \
    echo "=== ls public/build ===" && ls -la public/build || true; \
    echo "=== ls public/build/assets ===" && ls -la public/build/assets || true; \
    npm prune --omit=dev

CMD ["bash","-lc","php artisan migrate --force && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=$PORT"]
