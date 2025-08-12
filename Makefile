start:
	php artisan serve --host 0.0.0.0 --port 8000

start-frontend:
	npm run dev

setup:
	composer install
	cp -n .env.example .env || true
	php -r "is_dir('database') || mkdir('database'); file_exists('database/database.sqlite') || touch('database/database.sqlite');"
	sed -i.bak 's/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/; s|^DB_DATABASE=.*|DB_DATABASE=database/database.sqlite|' .env
	php artisan key:generate --ansi
	php artisan migrate --force
	npm ci
	npm run build

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

test-coverage:
	mkdir -p build
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/coverage.xml

lint:
	vendor/bin/phpcs --standard=PSR12 app/ routes/ tests/ database/

lint-fix:
	vendor/bin/phpcbf --standard=PSR12 app/ routes/ tests/ database/

stan:
	vendor/bin/phpstan analyse --no-progress --memory-limit=768M

stan-baseline:
	vendor/bin/phpstan analyse --generate-baseline --allow-empty-baseline
