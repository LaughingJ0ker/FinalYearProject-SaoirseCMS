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
	
	$name = "";
	$email = "";
	$mess = "";
	$phone = "";
	
	if(isset($_REQUEST['submitContactForm'])){
		$name = trim($_REQUEST['cname']);
		$email = trim($_REQUEST['cemail']);
		$phone = trim($_REQUEST['cphone']);
		$mess = trim($_REQUEST['cmess']);

		$error = "Error!";
		$errorConfirm = false;

		if(empty($name)){
			$error = $error." Name cannot be left blank!";
			$errorConfirm = true;
		}

		if(empty($email)){
			$error = $error." Email cannot be left blank!";
			$errorConfirm = true;
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = $error." Email address is invalid.";
			$errorConfirm = true;
		}

		if(!empty($phone) && !is_numeric($phone)){
			$error = $error." Phone number can only contain numbers.";
			$errorConfirm = true;
		}
		
		if(empty($mess)){
			$error = $error." Message cannot be left blank!";
			$errorConfirm = true;
		}

		if($errorConfirm){
			echo $error;
		}else{
		
		$query = 'SELECT email FROM email WHERE id =1';
		$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		while ($row = mysql_fetch_assoc($result)){
			$conemail = $row['email'];
		}
			
		$to = $conemail;
		$subject = "Website contact form submission";
		$body = "The below information was submitted through the contact form on your website<br /><br />From: $name <br />Email: $email<br />Phone: $phone<br />Message: $mess";
		
		//echo $body;
		
		if (mail($to, $subject, $body)) {
			echo("<p>Message successfully sent!</p>");
			$mess = "";
			$email = "";
			$name = "";
			$phone = "";
		} else {
			echo("<p>Message delivery failed...</p>");
		}
		}

	}
	?>
	<table frame="box" style="margin-left:5%">
	<tr>
	<td>

	You can use the contact form below to contact us. 
	<br />
	All items marked with a * are mandatory.
	</td>
	<tr>
		<form method="post">
		<tr>
		<td>Name:* </td>
		</tr>

		<tr>
		<td><input type="text" name="cname" size="20" value="<?php echo $name; ?>"></td>
		</tr>

		<tr>
		<td>Email:* </td>
		</tr>

		<tr>
		<td><input type="text" name="cemail" size="20" value="<?php echo $email; ?>"></td>
		</tr>
		
		<tr>
		<td>Phone: </td>
		</tr>

		<tr>
		<td><input type="text" name="cphone" size="20" value="<?php echo $phone; ?>"></td>
		</tr>

		<tr>
		<td>Message:* </td>
		</tr>

		<tr>
		<td><textarea name="cmess" rows="5" cols="30"><?php echo $mess; ?></textarea></td>
		</tr>
		<tr>
		<td><input type="submit" name="submitContactForm" value="Submit"><input type="reset" value="Reset"></td>
		</tr>
		</form>
	</table>
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

