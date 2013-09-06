<?php require("header.php");?>

		<div id="content">
			<h2>Delete a User</h2>
			<p>Below is a list of users currently in the database. If you wish to
				delete a user, hit the "Delete" button beside their name</p>
			<br>
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

			while ($row = mysql_fetch_assoc($result))
			{
				$id = $row['id'];
				$username = $row['username'];
				$password = $row['password'];
				$level = $row['privlevel'];

				echo "<tr>";
				echo "<td>". $id. "</td>";
				echo "<td>".$username."</td>";
				echo "<td>".$password."</td>";
				echo "<td>".$level."</td>";
				echo "<td> <form method='POST'><input type='hidden' name='userID' value='".$id."'> <input type='submit' name='submit' value='Delete User'></form></td>";
				echo "</tr>";
			}
			echo "</table>\n";
			?>

		</div>
	</div>
<?php

if(isset($_REQUEST['submit'])){
$id = $_REQUEST['userID'];

if(empty($id)){
echo 'Error! Field cannot be left blank';
exit();
}

$query = "DELETE FROM users WHERE id = '$id'";
$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
header ("Location:deleteUser.php");
}

?>
<?php require("footer.php");?>
