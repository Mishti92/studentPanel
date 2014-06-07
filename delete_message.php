<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit;
}


include 'template/header.php';


if(message_check($_GET['id']) === 0)
{
 header('Location: messages.php');
 exit();
}
else
{


if(isset($_GET['id']) || !empty ($_GET['id']))
{
  delete_message($_GET['id']);
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();
}
}

include 'template/footer.php';
?>