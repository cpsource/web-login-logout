#!/bin/bash

# Check if the symlink /var/www/html points to html-natdem-new
if [ "$(ls -l /var/www/html | awk '{print $NF}')" = "html-natdem-new" ]; then
  # Exit if it already points to html-natdem-new
  echo "/var/www/html already points to html-natdem-new. Exiting."
  logger -p local3.notice -t ubuntu.cron "/var/www/html already points to html-natdem-new. Exiting."
  exit 0
else
  # Change directory to /var/www
  cd /var/www || { echo "Failed to change directory to /var/www"; logger -p local3.notice -t ubuntu.cron "Failed to change directory to /var/www"; exit 1; }

  # Remove the current html symlink
  sudo rm -f html || { echo "Failed to remove the current html symlink"; logger -p local3.notice -t ubuntu.cron "Failed to remove the current html symlink"; exit 1; }

  # Create a new symlink pointing to html-natdem-new
  sudo ln -s html-natdem-new html || { echo "Failed to create a new symlink"; logger -p local3.notice -t ubuntu.cron "Failed to create a new symlink"; exit 1; }

  # Print success message and exit
  echo "Updated /var/www/html to point to html-natdem-new."
  logger -p local3.notice -t ubuntu.cron "Updated /var/www/html to point to html-natdem-new."
  exit 0
fi

