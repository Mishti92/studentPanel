<?php
include 'init.php';
if(logged_in())
{
	header('Location:home.php');
	exit;
}

else
{
	header('Location:sign_up.php');
	exit;
	
}

?>