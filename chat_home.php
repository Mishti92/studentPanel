<?php

include 'init.php';
$user_id=$_SESSION['user_id'];

ini_set('display_errors', '1');
if(!logged_in())
{
header('Location: index.php');
exit();
}
 ?>


 <! DOCTYPE html>
 <html>

   <head>
          <title>chat</title>
          <link rel="stylesheet" href="css/chatstyle.css">
   </head>

   <body> <div class="box">
         <div class ="chat">
         <div class="messages">
                        </div>
         <textarea class="entry" placeholder="Type here and hit Return. Use Shift+Return for a new line"></textarea>

         </div>  </div>


         <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
         <script src="js/chat.js"></script>

   </body>


 </html>

