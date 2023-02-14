<?php
  session_start();
  if( isset( $_SESSION[ 'login' ] ) ) {
    $jb_login = TRUE;
  } 
?>