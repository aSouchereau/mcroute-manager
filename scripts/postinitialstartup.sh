#!/bin/ash

TEST_FILE=/var/www/html/tempfile.txt

cd ~/var/www/html # App directory

if [ -f "$TEST_FILE" ]; then
  echo "Running initial setup" >&2
  php artisan migrate >&2


  rm "$TEST_FILE" # Delete file so this script wont run again on each startup
  echo "Setup Complete" >&2
else
  echo  "Skipping initial setup - Already ran" >&2
fi