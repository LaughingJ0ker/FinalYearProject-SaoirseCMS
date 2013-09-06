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
ini_set('date.timezone', 'Europe/London');
$date = date('h:ia d/m/Y ', time());
$date = $date." by user: ".$_SESSION['valid_user']."";

$int = (int)$sForm;

$privLevel = $_SESSION['privlevel'];
	
		if($privLevel == "publisher"){
			$query = 'UPDATE webpage SET content = "'.$postedValue.'" WHERE pageid='.$int.'';
			mysql_query($query) or die("<p>Insertion failed</p>\n");
			header('Location:' . $_SERVER['HTTP_REFERER'].'?viewPublished=true');  
		}else if($privLevel == "editor"){
			$query = 'UPDATE webpage SET unpubcontent = "'.$postedValue.'", lastmodified = "'.$date.'"  WHERE pageid='.$int.'';
			mysql_query($query) or die("<p>Insertion failed</p>\n");
			header('Location:' . $_SERVER['HTTP_REFERER']);
		}
		else{
			header('Location:' . $_SERVER['HTTP_REFERER']); 
		}			
	
		
	
}
?>
