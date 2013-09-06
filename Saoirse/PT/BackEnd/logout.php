<?php

// Log the user out using unset $_SESSION and session_destroy()


  session_start();
  unset($_SESSION['valid_user']);
  session_destroy();
  
  header("Location:login.php");

  
?>
