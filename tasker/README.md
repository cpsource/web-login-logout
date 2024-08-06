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

