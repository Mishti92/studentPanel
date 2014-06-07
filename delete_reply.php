<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit;
}


include 'template/header.php';

if(reply_check($_GET['reply_id']) === 0)
{
 header('Location: submit_topic.php');
 exit();
}


if(isset($_GET['reply_id']) || ! empty ($_GET['reply_id']))
{
  delete_reply($_GET['reply_id']);
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();
}



include 'template/footer.php';
?>