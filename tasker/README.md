# The tasker sub-system gives bash to html/php/css.

This code, in its entirety, was written by ChatGPT in only four hours. It made only one
mistake, which it corrected when I pointed it out.

## How does it work ?

  * html/php writes instructions into a SQLite database, called tasker.db
  * periodically, cron kicks off tasker.sh
  * tasker.sh checks tasker.db for instructions, and it if finds any will execute as a bash task.
  * task then returns any data via tasker.db
  * The php in html checks tasker.db for this completion and then displays it via html
  * The php in html then clears tasker.db

## Note: A log file is kept at /var/log/tasker/tasker
## Note: All database opens must be of this form:

  `$db = new SQLite3($dbPath,SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);`

but hopefully of the form:

'
	// Path to the SQLite3 database file
        $dbPath = '/var/www/data/tasker.db';

	try {
            // Open the database
            $db = new SQLite3($dbPath,SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
            echo "Database connection successful.";
	    } catch (Exception $e) {
                       	// Handle the exception if the connection fails
			echo "Failed to connect to the database: " . $e->getMessage();
			sleep(5);
	    }
`

## How to install

  * create a subdirectory called 'tasker' in the root of your web page and
    clone this toolkit there.
  * edit /etc/apache2/sites-enabled/000-default.conf, default-ssl.conf with
`
  <Directory /var/www/html/tasker>
      AllowOverride All
  </Directory>
`
  * add your own user + password via
`
    sudo htpasswd -c /var/www/html/tasker/.htpasswd username
`
  * restart apache2 via sudo systemctl restart apache2

  * run the script ./tasker_initialize.sh

  * create a crontab entry pointing to tasker.sh. You can set the time interval to whatever you think you need. Just man crontab to see how to do it. For testing, I used '* * * * * /var/www/html/tasker/tasker.sh for a one minute time.

## How to use tasker

  * just point your web browser at https://<yoursite>/tasker/tasker_enqueue.php and add your commands. Press submit.
  * you can check the status of the command via https://<yoursite>/tasker/tasker_status.php. Flag has the following values:
	- New Job - you've queued it but the cron job hasn't seen it yet
	- In Progress - it's being executed now (left for future expansion)
	- Completed - the job is over. You should see the results displayed
	- Acknowledged - you, the sysadmin, have acknowledged seeing the results
  * Once you see Acknowledged, you browse at https://<yoursite>/tasker/tasker_acknowledge.php and follow the prompts.



