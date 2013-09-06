
<?php require("header.php");?>

		<div id="content">
		<h2>Update GPS coordinates</h2>
		<p>Below, the GPS coordinates that embedded maps use can be updated. These are used to generate an embedded map when you create a "Location" page.</p>
		<?php
		
			$query = "SELECT * FROM locationinfo";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($result)){
				$gpslat = $row['gpslat'];
				$gpslon = $row['gpslon'];
				$gpsfull = $row['gpsfull'];

			}
			?>
			<table>
				<form method='post'>
				<tr>
				<td>Latitude: </td><td><input type='text' name='gpslat' value='<?php echo $gpslat ?>' size='25' maxlength='12'></td>
				</tr>
				<tr>
				<td>Longitude:</td><td><input type='text' name='gpslon' value='<?php echo $gpslon ?>' size='25' maxlength='12'></td>
				</tr>
				<tr>
				<td><input type='submit' name='submit' value='Update'></form></td>
				</tr>
				<tr>
				<td>Full Coordinates</td><td><?php echo $gpsfull ?></td>
				</tr>
			</table>
			If you are not sure about what you're coodinates are, you can use this <a href="http://www.itouchmap.com/latlong.html" target="_blank">website</a>.

		</div>
	</div>
<?php

	if(isset($_REQUEST['submit'])){
	$gpslat = $_REQUEST['gpslat'];
	$gpslon = $_REQUEST['gpslon'];

	$gpsfull = $gpslat.", ".$gpslon;
	
	if(!empty($gpslat) && !empty($gpslon)){		
		$query = "UPDATE locationinfo SET gpslat = '$gpslat', gpslon = '$gpslon', gpsfull = '$gpsfull' where id=1";
		$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
	}
	header("Location:updateGPS.php");

}

?>
<?php require("footer.php");?>
