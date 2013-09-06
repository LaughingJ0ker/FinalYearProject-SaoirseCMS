<?php require("header.php");

if(isset($_SESSION['authenticated'])){

$username = $_SESSION['valid_user'];
}

?>


		<div id="content">
			<h2>Change Layout of Website</h2>
			<?php
			

				$query = "SELECT * FROM sitelayout";
				$result = mysql_query($query) or die("SQL query failed");
				
				while($row = mysql_fetch_array($result)){
					$style = $row['layout'];
					$colour = $row['colour'];
					$custom = $row['usingcustom'];

				}
								echo "<h3>Preset Colours</h3>You may change the layout and/or colour of your website below. the listed layout and colour are what is currently running on your site.
				Although it may seem as if nothing happened after you click \"Change Layout\", it has updated unless it gives an error messgae. Simply close the
				popup to see the new look.<br><br>
				Current layout/colour scheme:";
			
			//Auto select the dropdown boxes using items from database 
			echo '<form action="presetLayout.php" method="post" name="layout">
				<select name="layoutStyle" value="options">';
				if($custom == "Yes"){
					echo '<option selected>Using Custom Layout</option>';
				}
				
				if($style == "LO1"){
					echo '<option selected value="LO1">Layout 1</option>';
				}else{
					echo '<option value="LO1">Layout 1</option>';
				}
				
				if($style == "LO2"){
					echo '<option selected value="LO2">Layout 2</option>';
				}else{
					echo '<option value="LO2">Layout 2</option>';
				}
				
				if($style == "LO3"){
					echo '<option selected value="LO3">Layout 3</option>';
				}else{
					echo '<option value="LO3">Layout 3</option>';
				}
				
				if($style == "LO4"){
					echo '<option selected value="LO4">Layout 4</option>';
				}else{
					echo '<option value="LO4">Layout 4</option>';
				}
				
				if($style == "LO5"){
					echo '<option selected value="LO5">Layout 5</option>';
				}else{
					echo '<option value="LO5">Layout 5</option>';
				}
				
				echo '</SELECT>';
				
				echo '<select name="layoutColour" value="options">';
				if($custom == "Yes"){
					echo '<option selected value="">Using Custom Colours</option>';
				}
				if($colour == "red"){
					echo '<option selected value="red">Red</option>';
				}else{
					echo '<option value="red">Red</option>';
				}
				
				if($colour == "blue"){
					echo '<option selected value="blue">Blue</option>';
				}else{
					echo '<option value="blue">Blue</option>';
				}
				
				if($colour == "green"){
					echo '<option selected value="green">Green</option>';
				}else{
					echo '<option value="green">Green</option>';
				}
				echo '</SELECT>';

				echo '<br><br><INPUT type="submit" value="Change Layout" name="submitLayout">';

			echo '</form>'; 
			?>


			</div>
		</div>
			<?PHP

			if (isset($_POST['submitLayout'])) {
				
				$style = $_REQUEST['layoutStyle'];
				$colour = $_REQUEST['layoutColour'];
				
				
				
				if($style != "Using Custom Colours"){
				
					if($style == null)
						$style='LO1';
				
					if($colour == null)
						$colour='blue';
					
					$filename = $style."/".$colour.".css";
			
					//$query = "update sitelayout set cssfilename = '$filename', layout = '$style',colour = '$colour',usingcustom = 'No' where styleid=1)";
					$query = "update sitelayout set cssfilename = '$filename', layout = '$style', colour = '$colour', usingcustom = 'No' where styleid=1";

					$result = mysql_query($query) or die("<b>Error, insertion failed.</b>");
				}

				header("Location: #");
			}

			require("footer.php");?>
