<?php
// try now to serialize database accesses
   try {
       sqlite3_config(SQLITE_CONFIG_SERIALIZED);
       echo "sqlite3_config successful.";
       } catch (Exception $e) {
       	 // Handle the exception if the connection fails
	 echo "sqlite3_config failed:" . $e->getMessage();
	 // display information about php
	 phpinfo();
	 sleep(5);
       }
?>

