#!/bin/ash

TEST_FILE=/var/www/html/tempfile.txt

cd /var/www/html # App directory

if [ -f "$TEST_FILE" ]; then
  echo "Starting initial setup"

  echo "Building scripts"
  npm run build

  echo "Configuring environment"
  [ ! -e /usr/local/bin/.env ] && \
  	sed 's|^#DB_DATABASE=$|DB_DATABASE='$DB_DATABASE'|' /var/www/html/.env.example > /usr/local/bin/.env
  chown -R mcroutemanager.mcroutemanager /usr/local/bin/.env
  [ ! -L /var/www/html/.env ] && \
  	ln -s /usr/local/bin/.env /var/www/html/.env
  	sh /usr/local/bin/inject.sh

  php artisan key:generate -n

  rm "$TEST_FILE" # Delete file so this script wont run again on each startup
  echo "Setup Complete"
else
  echo  "Skipping initial setup - Already ran"
fi