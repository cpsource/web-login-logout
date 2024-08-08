
# From time to time, my ubuntu apache2 server would hang

I added a cron job (check-apache2.sh) that will restart it if necessary

This is the README.md file for this subdirectory

point-web-to-natdem.sh - This is a file I use to make sure I'm serving the right web page. I use the
domain for other things, and this automatically resets it in case I forget.

This will log to /var/log/syslog.

# Installaton

Modify the script and replace https://natdem.org with your own web site.

Make sure logger and wget are installed.

Run crontab -e to run check-apache2.sh. The script can also be run from the command prompt to test it manually.
