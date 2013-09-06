<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Unauthorized access</title>
</head>
<body>
<center>
<h2>
<h2>Warning</h2>
<p>
<strong>You do not have permission to access this directory.</strong><br><br> Your IP address and date and time of access have been logged.<br> 
If you continue to try and gain access to this directoy, the authorites will be contacted and your information will be passed to them.
<br><br>
We will pursue action under <a href="http://www.irishstatutebook.ie/2001/en/act/pub/0050/sec0009.html#sec9">Section 10, Criminal Justice (Theft and Fraud Offences) Act, 2001</a> and/or <a href="http://www.irishstatutebook.ie/1991/en/act/pub/0031/sec0005.html#sec5">Section 5, Criminal Damage Act, 1991.</a>
</p><br><br>

<?php
$ip=$_SERVER['REMOTE_ADDR'];
echo "<b>IP Address= $ip</b>"; 

?>
</center>
</body>
</html>