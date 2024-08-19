#!/bin/bash

# Function to display help message
function show_help {
    echo "Usage: $0 {start|stop}"
    echo "  start: Enable ESM Apps, ESM Infra, and Livepatch"
    echo "  stop: Disable ESM Apps, ESM Infra, and Livepatch"
    exit 1
}

# Check if an argument is provided
if [ -z "$1" ]; then
    show_help
fi

# Perform actions based on the argument
case "$1" in
    start)
        sudo pro enable esm-apps
        sudo pro enable esm-infra
        sudo pro enable livepatch
        ;;
    stop)
        sudo pro disable esm-apps
        sudo pro disable esm-infra
        sudo pro disable livepatch
        ;;
    *)
        show_help
        ;;
esac

sudo pro status
