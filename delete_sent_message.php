<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit;
}


include 'template/header.php';


if(message_sent_check($_GET['id']) === 0)
{
 header('Location: messages._sent.php');
 exit();
}
else
{
if(isset($_GET['id']) || !empty ($_GET['id']))
{
  delete_sent_message($_GET['id']);
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();
}
}

include 'template/footer.php';
?>