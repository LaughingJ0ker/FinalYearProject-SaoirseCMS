	<script>
	$(document).ready(function(){ 
		$('#flip').click(function() {
			$('#panel').animate({width: 'toggle'});
		});
	});
	</script>
	
	<div id="footer">
		<?php
			$query = "SELECT * FROM sitefooter";
			$result = mysql_query($query) or die("SQL query failed");

			while ($row = mysql_fetch_assoc($result))
			{
				$pageFooter = $row['footer'];
			}
		?>
		<center><?php echo htmlspecialchars_decode($pageFooter) ?></center>

		<?php
		if (isset($_SESSION['normalUser']))
		{
			echo '<a href="logout.php">Logout</a> - User: '.$_SESSION['valid_user'].' - UserID: '.$_SESSION['userid'].' - User Privilege Level: '.$_SESSION['privlevel'].' - Current Page: '.$parts[count($parts) - 1];
		}
		else if(isset($_SESSION['authenticated']))
		{
			echo '<a href="logout.php">Logout</a>';
		 ?>

			<!-- modal content -->
			<div id="osx-modal-content">
				<div id="osx-modal-title">Administrator Panel</div>
				<div class="close"><a href="#" class="simplemodal-close">x</a></div>
				<div id="osx-modal-data">
				<iframe src="http://localhost/pt/backend/" width="100%" height="500px" scrolling="auto" border="0" frameborder="0">
				</iframe>			
				<p><button class="simplemodal-close">Close</button> <span>(or press ESC or click the overlay)</span></p>
				</div>
			</div>
				
		 <?php
		}
		else{
			?>
		<div id="flip">
			<a href="#">Login </a>
		</div>
		<div id="panel">
			<?php include("login.php");?>
		</div>
		<?php
			}
		?>
	</div>
</div>
</body>
</html>