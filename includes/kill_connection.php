<?php
/*
 *      kill_connection.php
 *      
 *      Copyright 2010 David Jelic <djelic@buksna.net>
 *      
 */
?>
<?php
// prikolji konekciju
if (isset($connection)) {
	mysql_close($connection);
}
?>
