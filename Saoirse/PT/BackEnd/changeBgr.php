<?php require("header.php");?>

		<div id="content">
		<?php
			$queryBgImg = "SELECT * FROM sitelayout";
			$resultBgImg = mysql_query($queryBgImg) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($resultBgImg)){
				$useBgImg = $row['useBgImg'];
			}	
		?>
		<h2>Website Background</h2>
		<p>You can specify if you would like to use a solid colour, or an image as your background. Select
		"No" to use a solid colour, or select "Yes" and the upload a background image using the button provided. Then hit "Save Background". 
		You can change background colour <a href="customLayout.php">here</a> (hit Save Background frist).
		Note: <strong>Image must be JPG format and
		called "bgimg.jpg"</strong>.</p>
		<?php
			$query = "SELECT * FROM sitefooter";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($result)){
				$footer = $row['footer'];
			}
		?>
		Use Background Image?
		<form method="post">
		<table>
			<tr>
				<td>
					<input type="radio" value="No" <?php if($useBgImg == "No") echo 'checked'; ?> name="useBgrImg" id="useBgrSolid">No
					<input type="radio" value="Yes"<?php if($useBgImg == "Yes") echo 'checked'; ?> name="useBgrImg"  id="useBgrImage">Yes
				</td>
				<td>
					<input type="button" id="bgbutton" onclick="popitup('../kcfinder/browse.php?type=files&dir=files/siteImages/bg_img')" value="Upload/Select Header Image">
				</td>
			<tr>
				<td><input type="submit" id="submittedBgImg" name="submitBgImg" value="Save Background"></td>
			</tr>
		</table>
		</form>
		<script language="javascript" type="text/javascript">
		<?php
			if($useBgImg == "No"){
			echo "$('#bgbutton').hide();";
			}
		?>
		function popitup(url) {
			newwindow=window.open(url,'name','height=400,width=600');
			if (window.focus) {newwindow.focus()}
			return false;
		}
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
	
	
	if(isset($_REQUEST['submitBgImg'])){
		$checked = $_REQUEST['useBgrImg'];
		if($checked == "No"){
			$query = "UPDATE sitelayout SET useBgImg = 'No' where styleid = 1";
			$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
			header("Location: #");
		}else{		
			$query = "UPDATE sitelayout SET useBgImg = 'Yes' where styleid = 1";
			$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
			header("Location: #");
		}
	}
?>
<?php require("footer.php");?>
