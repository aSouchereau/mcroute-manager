#!/bin/ash
function replace_or_insert() {
    echo "Replacing: ${1}"
    # Voodoo magic: https://superuser.com/a/976712
    grep -q "^${1}=" /usr/local/bin/.env && sed "s|^${1}=.*|${1}=${2}|" -i /usr/local/bin/.env || sed "$ a\\${1}=${2}" -i /usr/local/bin/.env
}

if [ "$APP_NAME" != '' ]; then
    replace_or_insert "APP_NAME" "$APP_NAME"
  fi
if [ "$APP_ENV" != '' ]; then
    replace_or_insert "APP_ENV" "$APP_ENV"
 fi
if [ "$APP_DEBUG" != '' ]; then
    replace_or_insert "APP_DEBUG" "$APP_DEBUG"
 fi
if [ "$APP_URL" != '' ]; then
    replace_or_insert "APP_URL" "$APP_URL"
 fi
if [ "$APP_DIR" != '' ]; then
    replace_or_insert "APP_DIR" "$APP_DIR"
 fi
if [ "$DB_CONNECTION" != '' ]; then
    replace_or_insert "DB_CONNECTION" "$DB_CONNECTION"
 fi
if [ "$DB_HOST" != '' ]; then
    replace_or_insert "DB_HOST" "$DB_HOST"
 fi
if [ "$DB_PORT" != '' ]; then
    replace_or_insert "DB_PORT" "$DB_PORT"
 fi
if [ "$DB_DATABASE" != '' ]; then
    replace_or_insert "DB_DATABASE" "$DB_DATABASE"
 fi
if [ "$DB_USERNAME" != '' ]; then
    replace_or_insert "DB_USERNAME" "$DB_USERNAME"
 fi
if [ "$DB_PASSWORD" != '' ]; then
    replace_or_insert "DB_PASSWORD" "$DB_PASSWORD"
 elif [ "$DB_PASSWORD_FILE" != '' ]; then
    value=$(<$DB_PASSWORD_FILE)
    replace_or_insert "DB_PASSWORD" "$value"
 fi
if [ "$DB_LOG_SQL" != '' ]; then
    replace_or_insert "DB_LOG_SQL" "$DB_LOG_SQL"
 fi
if [ "$DB_LOG_SQL_EXPLAIN" != '' ]; then
    replace_or_insert "DB_LOG_SQL_EXPLAIN" "$DB_LOG_SQL_EXPLAIN"
 fi
if [ "$TIMEZONE" != '' ]; then
    replace_or_insert "TIMEZONE" "$TIMEZONE"
 fi

if [ "$CACHE_DRIVER" != '' ]; then
    replace_or_insert "CACHE_DRIVER" "$CACHE_DRIVER"
 fi
if [ "$SESSION_DRIVER" != '' ]; then
    replace_or_insert "SESSION_DRIVER" "$SESSION_DRIVER"
 fi
if [ "$SESSION_LIFETIME" != '' ]; then
    replace_or_insert "SESSION_LIFETIME" "$SESSION_LIFETIME"
 fi
if [ "$QUEUE_CONNECTION" != '' ]; then
    replace_or_insert "QUEUE_CONNECTION" "$QUEUE_CONNECTION"
 fi

if [ "$PHP_TZ" != '' ]; then
    sed -i "s|;*date.timezone =.*|date.timezone = ${PHP_TZ}|i" /etc/php/8.2/cli/php.ini
    sed -i "s|;*date.timezone =.*|date.timezone = ${PHP_TZ}|i" /etc/php/8.2/fpm/php.ini
fi