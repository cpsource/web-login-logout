#!/bin/bash

# Check if /swapfile is already mounted
if swapon --show | grep -q '/swapfile'; then
    echo "/swapfile is already mounted. Exiting."
    exit 0
else
    echo "/swapfile is not mounted. Mounting now."
    sudo swapon /swapfile

    # Verify if it was successfully mounted
    if swapon --show | grep -q '/swapfile'; then
        echo "/swapfile mounted successfully."
        exit 0
    else
        echo "Failed to mount /swapfile."
        exit 1
    fi
fi

