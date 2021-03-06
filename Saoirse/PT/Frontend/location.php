<?php 
require("header.php");

function loggedIn(){
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);

$query1 = 'SELECT * FROM webpage WHERE filename ="'.$parts[count($parts) - 1].'"';
$result1 = mysql_query($query1) or die("<p>Insertion failed</p>\n");
while ($row = mysql_fetch_assoc($result1)){
	$pageid = $row['pageid'];
	$lastmod = $row['lastmodified'];
}

$content = "";	

if($_SESSION['privlevel'] == 'editor' ){
	$query = 'SELECT unpubcontent FROM webpage WHERE pageid ='.$pageid;
	$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
	while ($row = mysql_fetch_assoc($result)){
		$content = $row['unpubcontent'];
	}
	$message = "<b>Editor Level</b><br />The content below has not yet been <b>published</b>. Your privilege is not high enough to publish. If you would like this content published,<br />
					please contact the admin or a higher level user.";
					
}else if($_SESSION['privlevel'] == 'publisher' ){

	$viewPublished = "false";

	if(isset($_REQUEST['viewPublished'])){
		$viewPublished = $_REQUEST['viewPublished'];
	}
	$reloadTrue = $parts[count($parts) - 1]."?viewPublished=true";
	$reloadFalse = $parts[count($parts) - 1]."?viewPublished=false";
	
	if($viewPublished == "false"){
		$query = 'SELECT unpubcontent FROM webpage WHERE pageid ='.$pageid;
		$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		while ($row = mysql_fetch_assoc($result)){
			$content = $row['unpubcontent'];
		}
		
		if(is_null($lastmod)){
			$lastmod = "[[not yet updated]]";
		}
		$message = "<b>Publisher level</b><br>You are currently viewing <b>unpublished</b> content that has been updated at $lastmod. If you would like to publish this content, simply click the save button. 
		<br />When the page refreshes, you will still see the unpublished content. If you would like to see the published content, then <a href='".$reloadTrue."'>click here</a>.";
		}
	else{
			$query = 'SELECT content FROM webpage WHERE pageid ='.$pageid;
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
			while ($row = mysql_fetch_assoc($result)){
				$content = $row['content'];
			}
		$message = "<b>Publisher level</b><br>You are currently viewing <b>published</b> content. If you would like to update this content, simply edit it and click the save button.
		<br />When the page refreshes, you will still see the new published content. If you would like to see the unpublished content, then <a href='".$reloadFalse."'>click here</a>.";
	}
}

echo' 
	<div id="content">
		<div id="alerts">
			<noscript>
				<p>
				<strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript
				support, like yours, you should still see the contents (HTML data) and you should
				be able to edit it normally, without a rich editor interface.
				</p>
			</noscript>
		</div>';
		echo $message; 

		if($_SESSION['privlevel'] == "publisher")
		{
			if($viewPublished == "false"){
			echo '<br>';
			
			echo '<form action="'.$_SERVER['PHP_SELF'] .'" method="post" name="layout">';
			echo '<input type="hidden" value="'.$lastmod.'" name="lm">';
			echo '<input type="hidden" value="'.htmlspecialchars($content).'" name="con">';
			echo '<input type="text" name="reason" value="Enter reason for rejection" ONFOCUS="clearDefault(this)" size=60>';
			echo '<input type="submit" value="Reject Unpublished Content" name="noToUnpubContent">';
			echo '</form>';
			}
		}
		?>
		
			<form action="_posteddata.php" method="post">

			<p>
			
			<textarea class="ckeditor" cols="80" id="editor1" name="<?php echo $pageid; ?>" rows="10"><?php echo $content; ?></textarea>
			</p>

		</form>
	</div>
<script type="text/javascript">
function clearDefault(el) {
if (el.defaultValue==el.value) el.value = ""
}
</script>
	
<?php
}
function notLoggedIn(){
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);

$query1 = 'SELECT pageid FROM webpage WHERE filename ="'.$parts[count($parts) - 1].'"';
$result1 = mysql_query($query1) or die("<p>Insertion failed</p>\n");
while ($row = mysql_fetch_assoc($result1)){
	$pageid = $row['pageid'];
}

$content = "";	
$query = 'SELECT content FROM webpage WHERE pageid ='.$pageid;
$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
while ($row = mysql_fetch_assoc($result)){
	$content .= $row['content'];
}

?>
<div id="content">
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
	<tr>
	<td valign="top">

		<?php
			echo htmlspecialchars_decode($content);
		?>
	</td>
	<td>
	<?php
	if(empty($gpslon) || empty($gpslat)){
		echo "Error! No GPS coodinates entered. Please go into the administrator panel and enter/update GPS details";
	}else{
	?>
	<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
	src="http://www.openstreetmap.org/?mlat=<?php echo $gpslat ?>&mlon=<?php echo $gpslon ?>&zoom=15&layers=0B00FT" 
	style="border: 1px solid black"></iframe>
	<br /><small>
	<a href="http://www.openstreetmap.org/?mlat=<?php echo $gpslat ?>&mlon=<?php echo $gpslon ?>&zoom=15&layers=0B00FT" target="_blank">View Larger Map</a> - GPS Marker Coordinates: <?php echo $gpsfull; ?>
	</small>
	<?php
	}
	?>
	</td>
	</tr>
</table>
</div>
<?php
}

if(isset($_REQUEST['noToUnpubContent'])){
	
$lastmod = $_REQUEST['lm'];
$contentrej = $_REQUEST['con'];
$reasonForReject = $_REQUEST['reason'];

$currentPublisher = $_SESSION['valid_user'];
	
$deleteMessage = "Content below that was updated at $lastmod has been rejected by $currentPublisher for the following reason:<br><br><b> $reasonForReject</b><br><br><strong>Rejected Content</strong>:<br>$contentrej";
echo $deleteMessage;

$query = "update webpage set unpubcontent = '$deleteMessage' where pageid = $pageid";
$result = mysql_query($query) or die("<b>Error, insertion failed.</b>");

header("Location: #");
}

require("footer.php"); 
?>

