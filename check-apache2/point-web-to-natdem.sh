#!/bin/bash

# Check if the symlink /var/www/html points to natdem
if [ "$(ls -l /var/www/html | awk '{print $NF}')" = "natdem" ]; then
  # Exit if it already points to natdem
  echo "/var/www/html already points to natdem. Exiting."
  logger -p local3.notice -t ubuntu.cron "/var/www/html already points to natdem. Exiting."
  exit 0
else
  # Change directory to /var/www
  cd /var/www || { echo "Failed to change directory to /var/www"; logger -p local3.notice -t ubuntu.cron "Failed to change directory to /var/www"; exit 1; }

  # Remove the current html symlink
  sudo rm -f html || { echo "Failed to remove the current html symlink"; logger -p local3.notice -t ubuntu.cron "Failed to remove the current html symlink"; exit 1; }

  # Create a new symlink pointing to natdem
  sudo ln -s html-natdem html || { echo "Failed to create a new symlink"; logger -p local3.notice -t ubuntu.cron "Failed to create a new symlink"; exit 1; }

  # Print success message and exit
  echo "Updated /var/www/html to point to natdem."
  logger -p local3.notice -t ubuntu.cron "Updated /var/www/html to point to natdem."
  exit 0
fi

