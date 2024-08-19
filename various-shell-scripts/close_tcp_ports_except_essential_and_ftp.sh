#!/bin/bash

# Check if the script is run as root
if [ "$(id -u)" -ne 0 ]; then
  echo "This script must be run as root" >&2
  exit 1
fi

# Flush existing rules to start fresh
iptables -F

# Allow incoming TCP traffic on essential ports
iptables -A INPUT -p tcp --dport 22 -j ACCEPT   # SSH
iptables -A INPUT -p tcp --dport 80 -j ACCEPT   # HTTP
iptables -A INPUT -p tcp --dport 443 -j ACCEPT  # HTTPS
#iptables -A INPUT -p tcp --dport 53 -j ACCEPT   # DNS
iptables -A INPUT -p tcp --dport 21 -j ACCEPT   # FTP Control
iptables -A INPUT -p tcp --dport 20 -j ACCEPT   # FTP Data

# log
iptables -A INPUT -p tcp -m limit --limit 5/min -j LOG --log-prefix "TCP NDROP: " --log-level 4

# Drop all other incoming TCP traffic
iptables -A INPUT -p tcp -j DROP

# Save the iptables rules to make them persistent across reboots
#apt-get install -y iptables-persistent
#netfilter-persistent save

echo "All incoming TCP ports except SSH, HTTP, HTTPS, and FTP are now closed."

