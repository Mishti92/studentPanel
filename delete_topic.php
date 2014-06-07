<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit;
}


include 'template/header.php';


if(topic_check($_GET['topic_id']) === 0)
{
 header('Location: discuss.php');
 exit();
}
else
{

if(isset($_GET['topic_id']) || ! empty ($_GET['topic_id']))
{
  delete_topic($_GET['topic_id']);
  header('Location: discuss.php');
  exit();
}
}

include 'template/footer.php';
?>