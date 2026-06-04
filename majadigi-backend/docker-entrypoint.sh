#!/bin/bash
set -e

echo "=== Caching config ==="
php artisan config:cache

echo "=== Caching routes ==="
php artisan route:cache

echo "=== Caching views ==="
php artisan view:cache

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Module list ==="
php artisan module:list

echo "=== Testing Laravel boot ==="
php -r "
    \$_SERVER['APP_BASE_PATH'] = '/app';
    require '/app/vendor/autoload.php';
    try {
        \$app = require '/app/bootstrap/app.php';
        echo 'Laravel boot: OK' . PHP_EOL;
    } catch (\Throwable \$e) {
        echo 'Laravel boot FAILED: ' . \$e->getMessage() . PHP_EOL;
        echo \$e->getTraceAsString() . PHP_EOL;
        exit(1);
    }
"

echo "=== Starting Octane ==="
exec php artisan octane:frankenphp \
    --host=0.0.0.0 \
    --port=${PORT:-8080} \
    --workers=1 \
    --log-level=debug