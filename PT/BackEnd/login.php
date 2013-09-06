<?php
require_once("../db_connect.php");
$db_link = db_connect("projecttest");
session_start();
if (isset($_REQUEST['log']))
{

	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	
	$username = addslashes($username);
	$password = addslashes($password);
	
	$salt = "*salt_*";
	$password = $password.$salt; //simple salt
	
	$query = "SELECT * FROM admin WHERE username = '$username 'AND password = sha1('$password') LIMIT 0 , 30";

	$result = mysql_query($query);

	$numrows = mysql_num_rows($result);

	if ($numrows == 1)
	{
		$_SESSION['valid_user'] = $username;
		$_SESSION['authenticated'] = true;
		mysql_free_result($result);
		mysql_close();

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php">';
	}
	else
	{
		display_login_page("<span style='color:red'>Invalid login, try again</span>");
	}
}
else
{
	display_login_page("Please log in");
}
?>


<?php
function display_login_page($message)
{
	?>
<html>
<head>
<title>Admin Login Page</title>
<link rel="stylesheet" href="styles/loginStyles.css" type="text/css">
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript"
	src="http://malsup.github.com/jquery.corner.js"></script>
</head>
<body>
	<div id="loginWrapper">
		<h1>Administrator Login</h1>

		<h3>
			<?php echo $message ?>
		</h3>

		<form method="POST">

			<table id="loginTable">
				<tr>
					<td>User Name:</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="log"
						value="Log in"></td>
				</tr>
			</table>

		</form>
	Authorized access only. <br />Your IP and time of access have been logged.
	</div>
	<script>
$('#loginWrapper').corner();
</script>
</body>
</html>
<?php
}
?>

