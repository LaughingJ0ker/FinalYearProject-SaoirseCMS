<?php require("header.php");?>

		<div id="content">
			<h2>Create a Page</h2>
			<p>Enter the filename of the file you wish to create below.<br> Do not include the file extension, this will be added automatically.</p>
			<br>
			</form>		
			<table>
			
			<form method="post">
				<td>Filename: </td><td><input type="input" id="filename" name="filename" size="30" value="Filename" ONFOCUS="clearDefault(this)"></td>
				</tr>
				<tr>
				<td>Page Title: </td><td><input type="input" id="pagetitle" name="pageTitle" size="30" value="Page Title" ONFOCUS="clearDefault(this)"></td>
				</tr>
				<tr>
				<td>Page Type: </td>
				<td>
					<select id="type" name="type">
						<option value="normal">Normal Page</option>
						<option value="contactpage">Contact Page (contact form)</option>
						<option value="locpage">Location Page (embedded map)</option>
						<option value="gallery">Image Page (embedded gallery)</option>
					</select>
				</td>
				</tr>
				<td><input type="submit" id='submit' name='submit' value="Create Page" ></td>
				</tr>
			</form>
			</table>
		<div id="result">
			
			</div>
			</div>
			
		</div>

	</div>

<?php
if(isset($_REQUEST['submit'])){
	$pageType = trim($_REQUEST['type']);
	if($pageType == "normal"){
		$newpage = file_get_contents('newPHPFileContents.txt');
	}else if($pageType == "contactpage"){
		$newpage = file_get_contents('newPHPFileContents_ContactPage.txt');
	}else if($pageType == "locpage"){
		$newpage = file_get_contents('newPHPFileContents_LocationPage.txt');
	}else if($pageType == "gallery"){
		$newpage = file_get_contents('newPHPFileContents_GalleryPage.txt');
	}

	$filename = trim($_REQUEST['filename']);
	$pageTitle = trim($_REQUEST['pageTitle']);

	if(ctype_alnum($filename)){
		$filename = $filename.".php";

		$dirc = "../Frontend/";
		$myFile = $filename;

		if(file_exists($dirc.$myFile)){
			echo "<script> 	document.getElementById('result').innerHTML = '<p id=errorTxt><b>File already exists! Please use a different filename.</b></p>';</script>";
		}else{
			if(empty($filename) || empty($pageTitle)){
			echo "<script> 	document.getElementById('result').innerHTML = '<p id=errorTxt><b>No field can be left blank.</b></p>';</script>";
			}else{
				$query = "INSERT INTO webpage (pageTitle,filename) VALUES('$pageTitle','$filename')";
				$result = mysql_query($query) or die("<b>Error, insertion failed. Try a different ID.</b>");
			

				$fh = fopen($dirc.$myFile, 'w') or die("can't open file");
				fwrite($fh, $newpage);
				fclose($fh);
				echo "<script> 	document.getElementById('result').innerHTML = '<br><b>Page ".$filename." successfully created.</b>';</script>";		
			}
		}
	}else{
		echo "<script> 	document.getElementById('result').innerHTML = '<br><b>Filename cannot be blank and  can only contain letters or numbers, no spaces or special characters.</b>';</script>";	
	}
}
require("footer.php");

?>
