#!/bin/bash

# Subroutine to test Apache2 by performing a wget request
tst_apache2() {
  wget --timeout=5 --tries=1 https://natdem.org -O /dev/null >/dev/null 2>&1
  if [ $? -ne 0 ]; then
    return 1  # Return error code if wget fails
  else
    return 0  # Return success code if wget succeeds
  fi
}

# Check if Apache2 is running
if ! sudo systemctl is-active --quiet apache2 || ! tst_apache2; then
  echo "Apache2 is not running or not responding. Restarting..."
  echo "Apache2 is not running or not responding. Restarting..." | logger -p local3.notice -t ubuntu.cron
  sudo systemctl restart apache2
  if [ $? -eq 0 ]; then
    echo "Apache2 has been restarted successfully."
    echo "Apache2 has been restarted successfully." | logger -p local3.notice -t ubuntu.cron
  else
    echo "Failed to restart Apache2."
    echo "Failed to restart Apache2." | logger -p local3.notice -t ubuntu.cron
  fi
else
  echo "Apache2 is running normally."
  echo "Apache2 is running normally." | logger -p local3.notice -t ubuntu.cron
fi

