<?php require("header.php");?>

		<div id="content">
		<h2>Update Site Footer</h2>
		<p>Below you can update the site footer. This is the bit of text/information that appears at the bottom of every page of the site.</p>
		<?php
		
			$query = "SELECT * FROM sitefooter";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($result)){
				echo "<table>";
				$footer = $row['footer'];
				echo "<form method='post'>";
				echo "<tr>";
				echo "<td><input type='text' name='footer' value='".htmlspecialchars_decode($footer)."' size='75' maxlength='75'></td></tr><tr>";
				echo "<td><input type='submit' name='submit' value='Update'></form></td>";
				echo "</tr>";
			}
			echo "</table>";
		?>
		</div>
	</div>
<?php

	if(isset($_REQUEST['submit'])){
	$footer = trim($_REQUEST['footer']);

	$footer = addslashes($footer) ;

	if(!empty($footer)){		
		$query = "UPDATE sitefooter SET footer = '$footer'";
		$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
	}
	header("Location:updateFooter.php");

}

?>
<?php require("footer.php");?>
