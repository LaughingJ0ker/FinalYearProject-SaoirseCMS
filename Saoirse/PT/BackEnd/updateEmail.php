<?php require("header.php");?>

		<div id="content">
		<h2>Update Contact Email</h2>
		<p>Below, you can update your contact email. This is the email that the contact form on contact pages uses as the address to send mail to.</p>
		<?php
		
			$query = "SELECT * FROM email";
			$result = mysql_query($query) or die("<p>Insertion failed</p>\n");
		
			while($row = mysql_fetch_array($result)){
				$email = $row['email'];
			}
			?>
			<table>
				<form method='post'>
				<tr>
				<td><input type='text' name='email' value='<?php echo $email ?>' size='75' maxlength='75'></td></tr><tr>
				<td><input type='submit' name='submit' value='Update'></form></td>
				</tr>
			
			</table>
		</div>
	</div>
<?php

	if(isset($_REQUEST['submit'])){
	$email = trim($_REQUEST['email']);

	$email = addslashes($email);

	if(!empty($email)){		
		$query = "UPDATE email SET email = '$email' where id=1";
		$result = mysql_query($query) or die("<script> alert('Error. Update failed. This is likely because you have a special character such as a singular quote sumbol. Please remove this, and try again.'); </script>");
	}
	header("Location:updateEmail.php");

}

?>
<?php require("footer.php");?>
