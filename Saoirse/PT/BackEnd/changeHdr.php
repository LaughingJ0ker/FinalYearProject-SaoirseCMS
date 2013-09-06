<?php require("header.php");?>

		<div id="content">
		<h2>Website Header</h2>
		<p>If you would like to use text instead of a header image, you can specify this below. You can also choose the text you would like to use.
		To use a header image, select the "No" option below, and hit "Save Header". To use text/images, select "Yes", enter in the text/images you would 
		like to use, and hit "Save" (blue floppy disk). To update the header image, close this modal, and hover over the header image.
		</p>
		<?php
			$query = "SELECT * FROM siteheader";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($result)){
				$header = $row['header'];
				$useText = $row['useText'];
			}			
		?>
		Use Text as a Header?
		<table>
			<tr>
			<form method='post'>
				<td>
					<input type="radio" value="No" <?php if($useText == "No")echo "checked"; ?> name="useHdrTxt" id="useHdrTextNo">No
					<input type="radio" value="Yes" name="useHdrTxt" <?php if($useText == "Yes")echo "checked"; ?> id="useHdrTextYes">Yes
				</td>
			</tr>
			<tr>
				<td><input type="submit" id="submitted" name="submit" value="Save Header"></td>
			</tr>
			</form>
			<tr>
				<td>
					<div id="hdrTxt">					
						<form action="_posteddata.php" method="post">
						<p>
						<textarea class="ckeditor" cols="80" id="hdrTxt" name="headerck" rows="10"><?php echo $header; ?></textarea>
						</p>
						</form>
					</div>
				</td>
			</tr>
		</table>
		<script>
		<?php
			if($useText == "No"){
			echo "$('#hdrTxt').hide();";
			}
			
			if($useText == "Yes"){
			echo "$('#submitted').hide();";
			}
			
			
		?>
		</script>
		</div>
	</div>
<?php
	if(isset($_REQUEST['submit'])){
		$checked = $_REQUEST['useHdrTxt'];
		if($checked == "No"){
			$query = "UPDATE siteheader SET useText = 'No' where id = 1";
			$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
			header("Location: #");
		}else{
			$query = "UPDATE siteheader SET useText = 'Yes' where id = 1";
			$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
			header("Location: #");
		}
	}
?>
<?php require("footer.php");?>
