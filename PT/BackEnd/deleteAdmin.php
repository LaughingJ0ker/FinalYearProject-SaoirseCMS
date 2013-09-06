<?php require("header.php");?>

		<div id="content">
			<h2>Delete an Admin</h2>
			<p>Below is a list of admins currently in the database. If you wish to
				delete an admin, hit "Delete" button beside their name.</p>
			<br>
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

			while ($row = mysql_fetch_assoc($result))
			{
				$username = $row['username'];
				$password = $row['password'];

				echo "<tr>";
				echo "<td>".$username."</td>";
				echo "<td>".$password."</td>";
				echo "<td> <form method='POST'><input type='hidden' name='userUN' value='".$username."'> <input type='submit' name='submit' value='Delete Admin'></form></td>";
				echo "</tr>";
			}
			echo "</table>\n";
			?>
			<div id="resultAdmin"></div>

		</div>

	</div>
<?php
if(isset($_REQUEST['submit'])){
$userUN = $_REQUEST['userUN'];

if(empty($userUN)){
echo 'Error! Field cannot be left blank';
exit();
}

$query = "DELETE FROM admin WHERE username = '$userUN'";
$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
header ("Location:deleteAdmin.php");
}
?>
<?php require("footer.php");?>
