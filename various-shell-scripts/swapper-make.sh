#!/bin/bash

# test memory size

free --mega

# create a swapfile

sudo swapon --show
sudo fallocate -l 1G /swapfile
sudo chmod 0600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
sudo swapon --show

# add to /etc/fstab for a reboot

