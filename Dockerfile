ARG ALPINE_VERSION=3.17
FROM alpine:${ALPINE_VERSION}
LABEL Maintainer="Tim de Pater <code@trafex.nl>"
LABEL Description="Lightweight container with Nginx 1.22 & PHP 8.1 based on Alpine Linux."
# Setup document root
WORKDIR /var/www/html

# Install packages and remove default server definition
RUN apk add --no-cache \
  curl \
  nginx \
  npm \
  php81 \
  php81-ctype \
  php81-curl \
  php81-dom \
  php81-fileinfo \
  php81-fpm \
  php81-gd \
  php81-intl \
  php81-mbstring \
  php81-mysqli \
  php81-opcache \
  php81-openssl \
  php81-phar \
  php81-session \
  php81-xml \
  php81-xmlreader \
  php81-xmlwriter \
  php81-pdo_mysql \
  php81-pdo_sqlite \
  php81-tokenizer \
  supervisor

# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Configure nginx - http
COPY config/nginx.conf /etc/nginx/nginx.conf
# Configure nginx - default server
COPY config/conf.d /etc/nginx/conf.d/

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php81/php-fpm.d/www.conf
COPY config/php.ini /etc/php81/conf.d/custom.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create nonroot user
RUN adduser -D -s /bin/ash mcroutemanager

# Copy and set cron schedule
COPY config/crontab.txt /var/www/html/crontab.txt
RUN crontab /var/www/html/crontab.txt -u mcroutemanager

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R mcroutemanager.mcroutemanager /var/www/html /run /var/lib/nginx /var/log/nginx


# Add scripts
COPY --chown=mcroutemanager scripts /usr/local/bin/

# Add application
COPY --chown=mcroutemanager src /var/www/html/

# Create Log File
RUN touch /var/www/html/storage/logs/laravel.log && chown -R mcroutemanager.mcroutemanager /var/www/html/storage/logs/laravel.log

# Run composer install to install the dependencies
RUN composer install --optimize-autoloader --no-interaction --no-progress

# Install npm dependencies
RUN npm install --no-audit --no-progress

# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
