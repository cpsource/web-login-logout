#!/bin/bash

# This script checks if MariaDB is running on an Ubuntu system. 
# If MariaDB is not running, the script starts the service using systemctl.
# The script also logs the status and actions taken to the system log (syslog).

SERVICE="mariadb"

# Check the status of MariaDB
if systemctl is-active --quiet $SERVICE; then
    echo "$SERVICE is already running."
    logger "$SERVICE is already running."
else
    echo "$SERVICE is not running. Starting $SERVICE..."
    logger "$SERVICE is not running. Attempting to start $SERVICE..."
    
    sudo systemctl start $SERVICE

    # Verify if MariaDB started successfully
    if systemctl is-active --quiet $SERVICE; then
        echo "$SERVICE started successfully."
        logger "$SERVICE started successfully."
    else
        echo "Failed to start $SERVICE."
        logger "Failed to start $SERVICE."
    fi
fi

