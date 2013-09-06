<?php require("header.php");?>

		<div id="content">
			<h2>Delete a Page</h2>
			<p>Enter the filename of the file you wish to delete below.<br> Do not include the file extension, this will be added automatically. </p>
			<br>
			<?php
			$fields = mysql_list_fields("projecttest", "webpage");
			$num_columns = mysql_num_fields($fields);

			$queryAll = "SELECT * FROM webpage";
			$result = mysql_query($queryAll) or die("SQL query failed");

			echo '<table cellpadding = "5" >', "\n";

			// Display the column names

			echo "<tr>\n";
			for ($i = 0; $i < $num_columns-3; $i++)
			{
				echo "<th>", mysql_field_name($fields, $i), "</th>\n";
			}

			while ($row = mysql_fetch_assoc($result))
			{
				$pageid = $row['pageid'];
				$pageTitle = $row['pagetitle'];
				$filename = $row['filename'];

				echo "<tr>";
				echo "<td>". $pageid. "</td>";
				echo "<td>".$pageTitle."</td>";
				echo "<td><a href=../Frontend/".$filename." target='_blank' >".$filename."</a></td>";
				if($filename == "index.php"){
					echo "<td><input type='submit' name='submit' value='Cannot Delete \"Home\"' disabled></td>";
				}
				else{
					echo "<td> <form method='POST'><input type='hidden' name='pageID' value='".$pageid."'> <input type='hidden' name='filename' value='".$filename."'><input type='submit' name='submit' value='Delete Page'></form></td>";
				}
				echo "</tr>";
			}
			echo "</table>\n";
			?>
		</div>
	
	</div>
<?php

if(isset($_REQUEST['submit'])){
$id = $_REQUEST['pageID'];
$filename = $_REQUEST['filename'];

echo $id;

	if(empty($id)){
	echo 'Error! Field cannot be left blank';
	exit();
	}
	$query = "DELETE FROM webpage WHERE pageid = '$id'";
	$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
	
	$dirc = "../Frontend/";
	$filename = $filename;
	$myFile = $filename;
	unlink($dirc.$myFile);
	
	header ("Location:deletePage.php");

}

?>

<?php require("footer.php");?>
