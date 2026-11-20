# Mudah Website: one container per customer, run by MudahCloud on Easypanel.
# Web (FrankenPHP), queue worker and scheduler run together under supervisord.
# Everything the site keeps (SQLite database, uploads) lives in the /data volume.

# --- PHP dependencies ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts

# --- Front-end build (needs PHP for Wayfinder's route generation) ---
FROM dunglas/frankenphp:1-php8.4-bookworm AS assets
RUN apt-get update && apt-get install -y --no-install-recommends curl ca-certificates gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && install-php-extensions intl zip pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY --from=vendor /app /app
RUN cp .env.example .env && php artisan key:generate --force \
    && npm ci --no-audit --no-fund \
    && npm run build \
    && php artisan compro:fonts \
    && rm -rf node_modules .env

# --- Runtime ---
FROM dunglas/frankenphp:1-php8.4-bookworm
RUN apt-get update && apt-get install -y --no-install-recommends supervisor sqlite3 \
    && install-php-extensions intl zip pdo_sqlite opcache pcntl gd exif \
    && rm -rf /var/lib/apt/lists/* \
    && cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY docker/php.ini $PHP_INI_DIR/conf.d/zz-compro.ini
COPY docker/supervisord.conf /etc/supervisor/conf.d/compro.conf
COPY docker/entrypoint.sh /usr/local/bin/compro-entrypoint

WORKDIR /app
COPY --from=assets /app /app
RUN chmod +x /usr/local/bin/compro-entrypoint \
    && rm -rf tests .github node_modules \
    && mkdir -p /data

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/data/database.sqlite \
    SESSION_DRIVER=database \
    SESSION_SECURE_COOKIE=true \
    CACHE_STORE=database \
    QUEUE_CONNECTION=database \
    FILESYSTEM_DISK=public \
    SERVER_NAME=:8080

VOLUME /data
EXPOSE 8080

# The base image checks Caddy's admin endpoint (:2019), which `frankenphp php-server` turns off, so
# Swarm (Easypanel) would mark every container unhealthy and stop it. Laravel's /up instead; the
# first start runs migrations and installs the content, hence the start period.
HEALTHCHECK --interval=30s --timeout=5s --start-period=120s --retries=3 \
    CMD curl -fsS http://127.0.0.1:8080/up >/dev/null || exit 1

ENTRYPOINT ["compro-entrypoint"]
CMD ["supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
