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

