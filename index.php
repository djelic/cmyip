<?php
/*
 *      cmyip.php
 *      
 *      Copyright 2010 David Jelic <djelic@buksna.net>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
?>
<?php require_once("includes/connection.php"); ?>
<?php
if (isset($_GET['stats'])) {
	if (isset($_GET['limit'])) {
		$query = "SELECT * FROM ip_log ORDER BY id DESC LIMIT " . $_GET['limit'];
	} else {
		$query = "SELECT * FROM ip_log;";
	}
	$result = mysql_query($query, $connection);
	if (!$result) {
		die("Database query failed: " . mysql_error());
	}
	echo "<table border=\"1\">\r\n";
	echo "<tr><td><font size=\"2\" face=\"Verdana\"><strong>No.:</strong></font></td>" .
		"<td><font size=\"2\" face=\"Verdana\"><strong>IP address:</strong></font></td>" .
		"<td><font size=\"2\" face=\"Verdana\"><strong>Time:</strong></font></td>\r\n";
	while ($row = mysql_fetch_array($result)) {
		echo "<tr><td><font size=\"2\" face=\"Verdana\">{$row[0]}:</font></td>" .
			"<td><font size=\"2\" face=\"Verdana\">{$row[1]}</font></td>" .
			"<td><font size=\"2\" face=\"Verdana\">{$row[2]}</font></td></tr>\r\n";
	}
	echo "</table>\r\n";
	mysql_close($connection);
	exit();
} elseif (isset($_GET['dist'])) {
	$query = "SELECT COUNT(*) AS x, ip_address FROM ip_log " .
		"GROUP BY ip_address ORDER BY x;";
	$result = mysql_query($query, $connection);
	if (!$result) {
		die("Database query failed: " . mysql_error());
	}
	echo "<table border=\"1\">\r\n";
	echo "<tr><td><font size=\"2\" face=\"Verdana\"><strong>No.:</strong></font></td>" .
		"<td><font size=\"2\" face=\"Verdana\"><strong>IP address:</strong></font></td>";
	while ($row = mysql_fetch_array($result)) {
		echo "<tr><td><font size=\"2\" face=\"Verdana\">{$row[0]}:</font></td>" .
			"<td><font size=\"2\" face=\"Verdana\">{$row[1]}</font></td>";
	}
	echo "</table>\r\n";
	mysql_close($connection);
	exit();
}
?>
<?php
// Mazni IP adresu
$ip = getenv("REMOTE_ADDR");

if (!$ip) {
	$ip = "UNAVAILABLE";
} else {
	$curr_time = date('d/m/Y H:i:s');
	$query = "INSERT INTO ip_log (ip_address, date) VALUES ('{$ip}', '{$curr_time}')";
	$result = mysql_query($query, $connection);
	if (!$result) {
		die("Database query failed: " . mysql_error());
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Your IP is <?php echo $ip; ?> - Check My IP</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
	<h1>Your IP address is <?php echo $ip; ?></h1>
	<pre><a href="http://www.buksna.net/">buksna dot net</a></pre>
	<?php require_once("includes/analyticstracking.php"); ?>
</body>
</html>
<?php require_once("includes/kill_connection.php"); ?>
