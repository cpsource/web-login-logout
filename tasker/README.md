# The tasker sub-system gives bash to html/php/css.

## How does it work ?

  * html/php writes instructions into a SQLite database, called tasker.db
  * periodically, cron kicks off tasker.sh
  * tasker.sh checks tasker.db for instructions, and it if finds any will execute as a bash task.
  * task then returns any data via tasker.db
  * The php in html checks tasker.db for this completion and then displays it via html
  * The php in html then clears tasker.db

## Note: A log file is kept at /var/log/tasker/tasker

