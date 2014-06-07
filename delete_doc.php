<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit();

}

if(doc_check($_GET['doc_id']) === false)
{
 header('Location: documents.php');
 exit();
}


if(isset($_GET['doc_id']) || ! empty ($_GET['doc_id']))
{
  delete_doc($_GET['doc_id']);
  header('Location: '.$_SERVER['HTTP_REFERER']);
  exit();
}


?>