#!/bin/bash
apt-mark showmanual
sudo apt-mark auto <package_name>
apt-mark showmanual | grep <package_name>
sudo apt autoremove
