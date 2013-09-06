<?php
require_once("../db_connect.php");
$db_link = db_connect("projecttest");

if (isset($_REQUEST['log']))
{
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	
	$username = addslashes($username);
	$password = addslashes($password);
	
	$salt = "*salt_*";
	$password = $password.$salt; //simple salt

	$queryUser = "SELECT * FROM users WHERE username = '$username 'AND password = sha1('$password') LIMIT 0 , 30";
	$queryAdmin = "SELECT * FROM admin WHERE username = '$username 'AND password = sha1('$password') LIMIT 0 , 30";

	$resultUser = mysql_query($queryUser);
	$resultAdmin = mysql_query($queryAdmin);
	
	$numrowsAdmin = mysql_num_rows($resultAdmin);
	$numrowsUser = mysql_num_rows($resultUser);


	if ($numrowsAdmin == 1)
	{
		$_SESSION['valid_user'] = $username;
		$_SESSION['authenticated'] = true;
		$_SESSION['privlevel'] = "publisher";
		$_SESSION['isAdmin'] = "admin";
		mysql_free_result($result);
		mysql_close();

		header('Location:' . $_SERVER['HTTP_REFERER']);  
	}
	else if($numrowsUser == 1)
	{
		while ($row = mysql_fetch_assoc($resultUser))
		{
			$userID = $row['id'];
			$privlevel = $row['privlevel'];
		}
			
		$_SESSION['valid_user'] = $username;
		$_SESSION['normalUser'] = true;
		$_SESSION['userid'] = $userID;
		$_SESSION['privlevel'] = $privlevel;
		mysql_free_result($result);
		mysql_close();

		header('Location:' . $_SERVER['HTTP_REFERER']);  
	}
	else
	{
		display_login_page("Invalid login, try again");
	}
}
else
{
	display_login_page("Ener your details to login");
}

function display_login_page($message)
{
?>

	<div id="loginWrapper">
		<form method="POST">

			<table id="loginTable">
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username"></td>
					<td>Password:</td>
					<td><input type="password" name="password"></td>
					<td><input type="submit" name="log" value="Log in"></td>
				</tr>
			</table>

		</form>

	</div>
<?php
}
?>

