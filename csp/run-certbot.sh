#!/bin/bash

# Check if the script is run as root
if [ "$EUID" -ne 0 ]; then
    echo "This script must be run as root. Exiting."
    exit 1
fi

# Check if a site name was provided as an argument
if [ -z "$1" ]; then
    echo "Usage: $0 <sitename>"
    echo "Please provide the site name as an argument."
    exit 1
fi

# Assign the provided site name to a variable
SITE_NAME="$1"

# Run certbot with the provided site name
sudo certbot --apache --server https://acme-v02.api.letsencrypt.org/directory --preferred-challenges dns -d "*.${SITE_NAME}.org" -d "${SITE_NAME}.org"

# Prompt the user to restart Apache2, default is Yes
read -p "Would you like to restart Apache2 now? [Y/n]: " RESTART_APACHE
RESTART_APACHE=${RESTART_APACHE:-Y}

# Convert the input to lowercase for comparison
RESTART_APACHE=$(echo "$RESTART_APACHE" | tr '[:upper:]' '[:lower:]')

# Restart Apache2 if the user agrees or defaults to Yes
if [ "$RESTART_APACHE" == "y" ] || [ "$RESTART_APACHE" == "yes" ]; then
    sudo systemctl restart apache2
    echo "Apache2 was restarted."
else
    echo "Apache2 was not restarted."
fi

