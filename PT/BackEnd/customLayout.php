<?php require("header.php");

if(isset($_SESSION['authenticated'])){

$username = $_SESSION['valid_user'];
}

?>


		<div id="content">
			<h2>Change Colour Scheme of Website</h2>
			<?php
			

				$query = "SELECT * FROM sitelayout";
				$result = mysql_query($query) or die("SQL query failed");
				
				while($row = mysql_fetch_array($result)){
					$style = $row['layout'];
					$colour = $row['colour'];
					$sitebg = $row['backgroundcolour'];
					$navbg = $row['navcolour'];
					$conbg = $row['contentcolour'];
					$footbg = $row['footercolour'];
					$custom = $row['usingcustom'];
					$navhov = $row['navonhover'];
					$navtxt = $row['navtext'];
					$capital = $row['capitalnav'];
					$corner = $row['corner'];
					$width = $row['laywidth'];


				}	
				?>
				
				Below, you can change the colour scheme and layout of your website. You can choose a custom layout, 
				and apply custom colours and options to it. Use the preview button to see what your site will look 
				like before you publish! You can select a new layout, and hit the preview button and it will show
				you the newly selected layout, you can also do this with colours.

				<h3>Current colour scheme</h3>
				<strong>NB: You must hit "Save Layout & Colours" for your changes to be reflected on the website.</strong> 
				<abbr title='The colours in each of the boxes are the current colour scheme. You can choose any colours. To choose a colour, simply click the box beside the text box, and in the popup, choose your colour and hit "OK". You can also enter colours directly into the text boxes.'>Hover here for help</abbr>
				<br><br>
				<table>
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="layout">
					<tr>
					<td>Layout Style: </td><td>
					<select id="layoutS" name="layoutStyleCC" value="options">';
					<?php
					if($custom == "No"){
						echo '<option selected">Using Preset Colours</option>';
					}
					?>
					
					<option <?php if($style == "styles1") echo 'selected'; ?> value="styles1">Layout 1</option>
					<option <?php if($style == "styles2") echo 'selected'; ?> value="styles2">Layout 2</option>';
					<option <?php if($style == "styles3") echo 'selected'; ?> value="styles3">Layout 3</option>';
					<option <?php if($style == "styles4") echo 'selected'; ?> value="styles4">Layout 4</option>';
					<option <?php if($style == "styles5") echo 'selected'; ?> value="styles5">Layout 5</option>';
					
					</select></td>
					<td>Website Width</td><td>					
					<select id="layoutWidth" name="layoutStyleWidth" value="options">';
					
					<option <?php if($width == "50%") echo 'selected'; ?> value="50%">50%</option>
					<option <?php if($width == "60%") echo 'selected'; ?> value="60%">60%</option>
					<option <?php if($width == "70%") echo 'selected'; ?> value="70%">70%</option>
					<option <?php if($width == "80%") echo 'selected'; ?> value="80%">80%</option>
					<option <?php if($width == "90%") echo 'selected'; ?> value="90%">90%</option>

					</select></td>					
					</tr>
					<tr>
						<td>Website Background Colour</td>
						<td><input id="sitebg" class="multiple" type="text"  value="<?php if(isset($sitebg)){echo $sitebg;}else{echo 'FFFFFF';}?>" name="siteBG" readonly='readonly'/></td>
						<td>Content Background Colour</td>
						<td><input id="conbg" class="multiple" type="text" value="<?php if(isset($conbg)){echo $conbg;}else{echo 'FFFFFF';}?>" name="conBG" readonly='readonly'/></td>
					</tr>
					<tr>
						<td>Navigation Colour</td> 
						<td><input id="navbg" class="multiple" type="text" value="<?php if(isset($navbg)){echo $navbg;}else{echo 'FFFFFF';}?>" name="navBG" readonly='readonly'/></td>
						<td>Footer Background Colour</td> 
						<td><input id="footbg" class="multiple" type="text"  value="<?php if(isset($footbg)){echo $footbg;}else{echo 'FFFFFF';}?>" name="footBG" readonly='readonly'/></td>
					</tr>
					<tr>
						<td>Navigation (on mouse hover)</td> 
						<td><input id="navhov" class="multiple" type="text"  value="<?php if(isset($navhov)){echo $navhov;}else{echo 'FFFFFF';}?>" name="navhov" readonly='readonly'/></td>
						<td>Capitialize Navigation text? </td>
						<td><?php if($capital == "Yes"){echo'<input checked type="radio" name="capital" value="Yes">Yes';}else{echo'<input type="radio" name="capital" value="Yes">Yes';} if($capital == "No"){echo'<input checked type="radio" name="capital" value="No">No';}else{echo'<input type="radio" name="capital" value="No">No';}?></td>
					</tr>
					<tr>
						<td>Navigation (text colour)</td>
						<td><input id="navtxt" class="multiple" type="text"  value="<?php if(isset($navtxt)){echo $navtxt;}else{echo 'FFFFFF';}?>" name="navtxt" readonly='readonly'/></td>
						<td>Rounded Corners? </td>
						<td><?php if($corner == "Yes"){echo'<input checked type="radio" name="corner" value="Yes">Yes';}else{echo'<input type="radio" name="corner" value="Yes">Yes';} if($corner == "No"){echo'<input checked type="radio" name="corner" value="No">No';}else{echo'<input type="radio" name="corner" value="No">No';}?></td>
					</tr>
					<tr>
				
						<td><INPUT type="submit" value="Save Layout & Colours" name="submitColour"></td>
						<!--<td><INPUT type="submit" value="Preview Colours" name="previewColours"></td>-->
						<td><input type="button" onclick="return popitup('preview.php')" value="Preview Layout"></td>

					</tr>
					</form>
				</table>
			<?php
			if($custom == "No"){
				echo 'Note: You are currently using a preset colour scheme. To use a custom colours, please select a layout in the "Layout Style" option above.';
			}
			?>
			</div>
			<script type="text/javascript">

			$(function()
			{
				$.fn.jPicker.defaults.images.clientPath='scripts/images/';
				$('.multiple').jPicker();
			});
			  
			function popitup(url) {
			var sbg = document.getElementById('sitebg').value;
			var nbg = document.getElementById('navbg').value;
			var cbg = document.getElementById('conbg').value;
			var fbg = document.getElementById('footbg').value;
			var noh = document.getElementById('navhov').value;
			var ntx = document.getElementById('navtxt').value;
			var lay = document.getElementById('layoutS').value;
			var laW = document.getElementById('layoutWidth').value;
			var cap = "No";
			var inputsCap = document.getElementsByName('capital');
            for (var i = 0; i < inputsCap.length; i++) {
              if (inputsCap[i].checked) {
                cap = inputsCap[i].value;
              }
            }
			
			var cor = "No";
			var inputs = document.getElementsByName('corner');
            for (var i = 0; i < inputs.length; i++) {
              if (inputs[i].checked) {
                cor = inputs[i].value;
              }
            }

			
			url = "preview.php?sitebg="+sbg+"&navbg="+nbg+"&conbg="+cbg+"&footbg="+fbg+"&navhov="+noh+"&navtxt="+ntx+"&layout="+lay+"&width="+laW+"&capital="+cap+"&corner="+cor+"";
			
				newwindow=window.open(url,'name','height=600,width=800');
				if (window.focus) {newwindow.focus()}
				return false;
			}
		
		</script>
			</div>
			<?PHP

			if (isset($_POST['submitColour'])) {
				$style = $_REQUEST['layoutStyleCC'];
				$width = $_REQUEST['layoutStyleWidth'];
				$siteBG = $_REQUEST['siteBG'];
				$navBG = $_REQUEST['navBG'];
				$conBG = $_REQUEST['conBG'];
				$footBG = $_REQUEST['footBG'];
				$navhov = $_REQUEST['navhov'];
				$navtxt = $_REQUEST['navtxt'];
				$capital = $_REQUEST['capital'];
				$corner = $_REQUEST['corner'];
				
				$filename = $style.".php";

				
				if($style != "Using Preset Colours"){				
				$query = "update sitelayout set cssfilename = '$filename', usingcustom = 'Yes', layout = '$style', colour='NULL', laywidth='$width', backgroundcolour = '$siteBG', navcolour = '$navBG', contentcolour = '$conBG', footercolour='$footBG', navonhover='$navhov', navtext='$navtxt', capitalnav='$capital', corner='$corner' where styleid=1";
				$result = mysql_query($query) or die("<b>Error, insertion failed.</b>");
				}
				header("Location: #");

			}
			require("footer.php");?>
