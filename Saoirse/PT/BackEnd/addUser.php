<?php require("header.php");?>
		<div id="content">
			<h2>Add a user</h2>
			<p>Use the form below to add a user to the database. This user will be
				able to manipulate all content on the website.</p>
			<form method="post">
				<table>
					<tr>
						<td><b><abbr title="Alphanumeric, 15 characters max">Username</abbr>
						</b></td>
						<td><input type="text" name="username" value="" size="20" maxlength="25"></td>
					</tr>
					<tr>
						<td><b><abbr title="Alphanumeric, 15 characters max">Password</abbr>
						</b></td>
						<td><input type="text" name="password" value="" size="20" maxlength="25"></td>
					</tr>
					<tr><td><b><abbr title="Privilage level of user.">Editor Level</abbr></b></td><td>
					<select id="level" name="level">
						<option value="editor">Editor</option>
						<option value="publisher">Publisher</option>
					</select>
					<td>
					</tr>
					<tr>
						<td><input type="submit" name="submitUser" value="Add User"></td>
					</tr>
				</table>
			</form>
			<div id="resultUser"></div>
			<hr width="550px">
			<h2>Add an Administrator</h2>
			<p>Use the form below to add a administrator to the database. This user
				will be able to manipulate all content on the website.</p>
			<form method="post">
				<table>
					<tr>
						<td><b><abbr title="Unique, alphanumeric, 15 characters max">Username</abbr>
						</b></td>
						<td><input type="text" name="usernameAdmin" value="" size="20"
							maxlength="15"></td>
					</tr>
					<tr>
						<td><b><abbr title="Alphanumeric, 15 characters max">Password</abbr>
						</b></td>
						<td><input type="text" name="passwordAdmin" value="" size="20"
							maxlength="15"></td>
					</tr>

					<tr>
						<td><input type="submit" name="submitAdmin" value="Add Admin"></td>
					</tr>
				</table>
			</form>
			<div id="resultAdmin"></div>
		</div>

	</div>

<?php
if(isset($_REQUEST['submitUser'])){
$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);
$level = $_REQUEST['level'];
$salt = "*salt_*";
	
$username = addslashes($username);
$password = addslashes($password);

if(empty($username) || empty($password)){
echo "<script> 	document.getElementById('resultUser').innerHTML = '<br><b>No field can be left blank!</b>';</script>";
}else{

$password = $password.$salt;
$query = "INSERT INTO users (username,password,privlevel) VALUES('$username',SHA1('$password'),'$level')";
$result = mysql_query($query) or die("<script> 	document.getElementById('resultUser').innerHTML = '<br><b>Error, insertion failed.</b>';</script>");
echo"<script> 	document.getElementById('resultUser').innerHTML = '<br><b>User ".$username." Successfully Added!</b>';</script>";
}
}
if(isset($_REQUEST['submitAdmin'])){

$usernameAdmin = trim($_REQUEST['usernameAdmin']);
$passwordAdmin = trim($_REQUEST['passwordAdmin']);
$salt = "*salt_*";
$usernameAdmin = addslashes($usernameAdmin);
$passwordAdmin = addslashes($passwordAdmin);

if(empty($usernameAdmin) || empty($passwordAdmin)){
echo "<script> 	document.getElementById('resultAdmin').innerHTML = '<br><b>No field can be left blank!</b>';</script>";
}else{
$passwordAdmin = $passwordAdmin.$salt;
$query = "INSERT INTO admin (username,password) VALUES('$usernameAdmin',SHA1('$passwordAdmin'))";
$result = mysql_query($query) or die("<script> 	document.getElementById('resultAdmin').innerHTML = '<br><b>Error, insertion failed. Try a different username.</b>';</script>");
echo"<script> 	document.getElementById('resultAdmin').innerHTML = '<br><b>Administrator ".$usernameAdmin." Successfully Added!</b>';</script>";
}	
}
?>
<?php require("footer.php");?>
