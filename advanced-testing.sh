#!/bin/bash
# Advanced testing - interesting
apt install mariadb-server -y
# Or use https://mariadb.com/kb/en/mariadb-package-repository-setup-and-usage/
# Start MariaDB
service mariadb start
# Create a database named "public"
mariadb -e "CREATE DATABASE public;"
# Set root password to "public" for login
mariadb -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('public');"
# -----------------------------------------------------
#              Alternative syntaxes
# -----------------------------------------------------
# ALTER USER 'root'@'localhost' IDENTIFIED BY 'public';
# ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by 'public';
# CREATE USER 'test'@'%' IDENTIFIED BY 'public';
# GRANT ALL PRIVILEGES ON *.* TO 'test'@'%';
# FLUSH PRIVILEGES;
# -----------------------------------------------------
# Login on the page http://127.0.0.1:8091/phpmyadmin/
# Enjoy !
