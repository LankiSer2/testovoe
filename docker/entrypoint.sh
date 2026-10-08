#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
  echo "APP_KEY is not set. Generate one with: php artisan key:generate --show"
  exit 1
fi

# Render gives PORT; default for local docker
PORT="${PORT:-10000}"
APP_URL="${APP_URL:-http://localhost:${PORT}}"
export APP_URL

php artisan config:clear
php artisan migrate --force
php artisan l5-swagger:generate || true

exec php artisan serve --host=0.0.0.0 --port="$PORT"


