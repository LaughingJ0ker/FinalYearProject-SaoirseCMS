
<?php require("header.php");?>

		<div id="content">
		<h2>Update Gallery information</h2>
		<p>Below, you can update the size of all galleries which are displayed on the Gallery pages pages created on <a href="createPage.php">create a page</a></p>
		<?php
		
			$query = "SELECT * FROM sitelayout";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($result)){
				$galleryheight = $row['galleryheight'];
				$gallerywidth = $row['gallerywidth'];

			}
			?>
			<table>
				<form method='post'>
				<tr>
					<td>Gallery Height: </td><td><input type='text' name='gh' value='<?php echo $galleryheight ?>' size='25' maxlength='12'></td>
				</tr>
				<tr>
					<td>Gallery Width:</td><td><input type='text' name='gw' value='<?php echo $gallerywidth ?>' size='25' maxlength='12'></td>
				</tr>
				<tr>
					<td><input type='submit' name='submit' value='Update Gallery Size'></td>
				</tr>
				</form>
			</table>
			Note: A custom width/height only applies when you choose a custom defined layout on the <a href="customLayout.php">Custom Layout</a> page.	
			
			
			<h3>Gallery Images</h3>
			<p>If you would like to change the images which are displayed in you gallery, you simply have to update the images in the "galleryImages" folder, 
			using the button below.<br />
			Filetypes must be JPG.
			
			</p>
			
			<br />
			<input type="button" id="bgbutton" onclick="popitup('../kcfinder/browse.php?type=files&dir=files/siteImages/galleryImages')" value="Update/Upload Gallery Images">

			
		</div>
	</div>
	<script language="javascript" type="text/javascript">
	function popitup(url) {
		newwindow=window.open(url,'name','height=480,width=640');
		if (window.focus) {newwindow.focus()}
		return false;
	}
	</script>
<?php

	if(isset($_REQUEST['submit'])){
	$gh = $_REQUEST['gh'];
	$gw = $_REQUEST['gw'];
	
	if(!empty($gh) && !empty($gw)){		
		$query = "UPDATE sitelayout SET galleryheight = '$gh', gallerywidth = '$gw' where styleid=1";
		$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
	}
	header("Location: #");

}

?>
<?php require("footer.php");?>
