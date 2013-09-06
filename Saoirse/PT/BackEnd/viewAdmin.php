<?php require("header.php");?>

		<div id="content">
			<h2>Updating and Viewing Admins</h2>
			<p>
				Below you can update an admin password. You cannot edit the username, and this
				must remain consistant. If you wish to change the username, you must create a new admin <a href="addUser.php">here</a>. If you leave a password field blank, nothing will happen, the password will remain the same as before. <br> <br> <b>NB: The
					passwards are "hashed" (encrypted). When you enter a new password, it
					will automaticlly become hashed.</b>
			</p>

			<?php

			$fields = mysql_list_fields("projecttest", "admin");
			$num_columns = mysql_num_fields($fields);



			$query = "SELECT * FROM admin";
			$result = mysql_query($query) or die("SQL query failed");

			echo '<table cellpadding = "5" >', "\n";

			// Display the column names

			echo "<tr>\n";
			for ($i = 0; $i < $num_columns; $i++)
			{
				echo "<th>", mysql_field_name($fields, $i), "</th>\n";
			}

			while($row = mysql_fetch_array($result)){

				$username = $row['username'];
				$password = $row['password'];
				echo "<tr>";
				echo "<td><form method='post'><input type='text' id='notEditable' name='username' value='$username' size='15' maxlength='15' readonly='readonly'></td>";
				echo "<td><input type='text' name='password' value='$password' size='50' maxlength='15'	ONFOCUS='clearDefault(this)'></td>";
				echo "<td><input type='submit' name='submit' value='Update'></form></td>";
				echo "</tr>";
			}
			echo "</table>";

			?>
		</div>
	</div>


<?php

	if(isset($_REQUEST['submit'])){
	$username = trim($_REQUEST['username']);
	$password = trim($_REQUEST['password']);
	$salt = "*salt_*";
	$username = addslashes($username);
	$password = addslashes($password);
	
	if(!empty($password)){
		$password = $password.$salt;
		
		$query = "UPDATE admin SET password = sha1('$password') WHERE username='$username'";
		$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
	}
	header("Location:viewAdmin.php");

}

?>
<?php require("footer.php");?>
