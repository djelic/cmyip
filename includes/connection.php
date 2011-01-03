<?php
/*
 *      connection.php
 *      
 *      Copyright 2010 David Jelic <djelic@buksna.net>
 *      
 */
?>
<?php
require("constants.php");

// spajanje na bazu
$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
if (!$connection) {
	die("Database connection failed: " . mysql_error());
}

// odaberi bazu
$db_select = mysql_select_db(DB_NAME, $connection);
if (!$db_select) {
	die("Database selection failed: " . mysql_error());
}
?>
