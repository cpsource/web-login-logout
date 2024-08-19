#!/bin/bash

# Check if the script is run as root
if [ "$(id -u)" -ne 0 ]; then
  echo "This script must be run as root" >&2
  exit 1
fi

# Display the current iptables rules
echo "Current iptables rules:"
iptables -L -v -n

