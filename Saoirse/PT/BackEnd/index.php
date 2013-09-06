<?php require("header.php");

$username = "";

if(isset($_SESSION['authenticated'])){

$username = $_SESSION['valid_user'];
}

?>


		<div id="content">
			
			<h2>Welcome <?php echo $username; ?></h2>
			<p>
			This is the administrator section of you website. From here, you can <a href="addUser.php">add</a>, <a href="deleteUser.php">delete</a> or <a href="viewUser.php">update</a> 
			a  users username and/or password.
			You can also create and delete administratiors and change their passwords.
			</p>
			<p>
			This is also the section where you <a href="createPage.php">create</a> and <a href="deletePage.php">delete</a> front end webpages 
			from your website. If you create a page, it will automatically be added into the links on you website.
			</p>
		</div>
	</div>

<?php require("footer.php");?>
