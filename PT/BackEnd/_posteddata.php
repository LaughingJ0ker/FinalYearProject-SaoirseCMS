<?php
require_once("../db_connect.php");
session_start();
$sid = session_id();
$db_link = db_connect("projecttest");
	

if ( isset( $_POST ) )
	$postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
	$postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
	else
		$postedValue = htmlspecialchars( $value ) ;
}
if(isset($sForm)){
	
			$query = 'UPDATE siteheader SET header = "'.$postedValue.'", useText = "Yes"';
			mysql_query($query) or die("<p>Insertion failed</p>\n");
			echo $query;
			echo $postedValue;
			header('Location:' . $_SERVER['HTTP_REFERER']); 
	
}		
?>
