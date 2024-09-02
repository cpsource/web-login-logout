#!/bin/bash
sudo update-alternatives --set php /usr/bin/php8.2
sudo update-alternatives --set phpize /usr/bin/phpize8.2
sudo update-alternatives --set php-config /usr/bin/php-config8.2
php -v
#
sudo a2dismod php8.3   # Replace 7.x with your current PHP version, e.g., 7.4, 8.0, etc.
sudo a2enmod php8.2
sudo systemctl restart apache2
