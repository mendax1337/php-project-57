FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    curl \
    git \
    unzip \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install bcmath pdo pdo_pgsql zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY . .

RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

ENV NPM_CONFIG_PRODUCTION=false
RUN npm ci --no-audit --no-fund

RUN npm run build

RUN test -f public/build/manifest.json \
 && echo "=== manifest.json ===" \
 && head -c 300 public/build/manifest.json || (echo "manifest.json NOT FOUND" && exit 1)
RUN echo "=== ls public/build ===" && ls -la public/build || true
RUN echo "=== ls public/build/assets ===" && ls -la public/build/assets || true

RUN npm prune --omit=dev

CMD ["bash", "-lc", "php artisan migrate --force && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=$PORT"]
