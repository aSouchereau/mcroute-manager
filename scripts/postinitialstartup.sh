#!/bin/ash

TEST_FILE=/var/www/html/tempfile.txt

cd ~/var/www/html # App directory

if [ -f "$TEST_FILE" ]; then
  echo "Starting initial setup"

  echo "Building scripts"
  npm run build

  echo "Running migrations"
  php artisan migrate

  rm "$TEST_FILE" # Delete file so this script wont run again on each startup
  echo "Setup Complete"
else
  echo  "Skipping initial setup - Already ran"
fi