<?php
//this file at top of every page                  	// Start headers and sessions
ob_start();
session_start();
	// MySQL Connection
	mysql_connect('localhost','root','');
	mysql_select_db('asp');
 // Include func files
	include("func/album.func.php");
	include("func/image.func.php");
	include("func/user.func.php");
	include("func/doc.func.php");
	include("func/topics.func.php");
        include("func/message.func.php");
        include("func/notes.func.php");
        include("func/thumb.func.php");

?>