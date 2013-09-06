<?php 
ob_start(); 
require("header.php");?>

		<div id="content">
			<h2>Updating and Viewing users</h2>
			<p>
				Below you can update user details. You cannot edit the ID, and this
				must remain consistant for a given user. <br> <br> If you leave any field blank, nothing will get updated. 
				You can update the username without updating the passowrd<br><br>
			<b>NB: The
				passwards are "hashed" (encrypted). When you enter a new password, it
				will automaticlly become hashed.</b>
			
			</p>

			<?php

			$fields = mysql_list_fields("projecttest", "users");
			$num_columns = mysql_num_fields($fields);

			$query = "SELECT * FROM users";
			$result = mysql_query($query) or die("SQL query failed");

			echo '<table cellpadding = "5" >', "\n";

			// Display the column names

			echo "<tr>\n";
			for ($i = 0; $i < $num_columns; $i++)
			{
				echo "<th>", mysql_field_name($fields, $i), "</th>\n";
			}

			while($row = mysql_fetch_array($result)){

				$id = $row['id'];
				$username = $row['username'];
				$password = $row['password'];
				$level = $row['privlevel'];
				
				echo "<tr>";
				echo "<td><form method='post'><input type='text' id='notEditable' name='id' value='$id' size='3' maxlength='5' readonly='readonly'></td>";
				echo "<td><input type='text' name='username' value='$username' size='15' maxlength='15'></td>";
				echo "<td><input type='text' name='password' value='$password' size='50' maxlength='20'  ONFOCUS='clearDefault(this)'></td>";
				echo '<td><select id="level" name="level">';?>
				<option <?php if($level == "editor") echo 'selected'; ?> value="editor">Editor</option>';
				<option <?php if($level == "publisher") echo 'selected'; ?> value="publisher">Publisher</option>'; 
				<?php 
				echo '</select></td>';
				echo "<input type='hidden' name='oldpass' value='$password'>";
				echo "<td><input type='submit' name='submit' value='Update'></form></td>";
				echo "</tr>";
			}
			echo "</table>";
			?>
			<div id="result">
			
			</div>
		</div>
	</div>

<?php

	if(isset($_REQUEST['submit'])){
	$id = trim($_REQUEST['id']);
	$username = trim($_REQUEST['username']);
	$password = trim($_REQUEST['password']);
	$newlevel = $_REQUEST['level'];

	$oldpass = trim($_REQUEST['oldpass']);
	$salt = "*salt_*";	
	
	if((!empty($password)) && (!empty($username))){
	echo "hi1";
	
		//Check if password changed, if yes, update it, if not, leave it alone and if blank update username, but ignore password.
		if($oldpass == $password){
			$query = "UPDATE users SET username = '$username', privlevel = '$newlevel' WHERE id='$id'";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
			
		}else{		
			$password = $password.$salt;
			$query = "UPDATE users SET username = '$username', password = sha1('$password'), privlevel = '$newlevel' WHERE id='$id'";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		}
	}
	header("Location:viewUsers.php");

}

?>
<?php require("footer.php"); ob_flush();?>
