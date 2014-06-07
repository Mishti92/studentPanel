<?php
include 'init.php';
if(!logged_in())
{
  header('Location: index.php');
  exit();
}

if(!isset($_GET['album_id']) || empty($_GET['album_id']) )
{
  header('Location: albums.php');
  exit();
}

include 'template/header.php';
?>
<section id="section">
<div id="section_submit">
<?php

$album_id=$_GET['album_id'];

$album_data = album_data($album_id,'name','description','course','year');


echo '<div id="page_head"><h3>'.$album_data['name'].'</h3></div>
<div id="forumlist_head"><div id="forum_post">'.$album_data['description'].'</div></div>'.'
<div id="forumlist_head"><div id="forum_post">'.$album_data['year'].' '.$album_data['course'].'</div></div>';


$images = get_images($album_id);


if(empty($images))
{
  echo '<div id="forumlist"><div id="forum_category"></div><div id="forum_post">There are no images in this album.';

  if (album_check($_GET['album_id']) === false)
  {
   echo '';
  }
  else
  {
    echo '<a href="upload_image.php"> Add images to the album</a></div></div>';
  }
}
else
{
echo '<div id="forumlist">';
  foreach($images as $image)
  {
    echo ' <a href = "uploads/'.$image['album'].'/'.$image['id'].'.'.$image['ext'].'">
    <img src="uploads/thumbs/'.$image['album'].'/'.$image['id'].'.'.$image['ext'].'" title="Uploaded '. @date('D M Y / h:i',$image['timestamp']).'"></a>[<a href ="delete_image.php?image_id='.$image['id'].'">x</a>] ';
  }
  echo '</div>';
  
 ?>
 <div id="forumlist_head">
 <div id="forum_post">
 </div>
 <div id="forum_category">
<a href="upload_image.php"> Add images</a>
 </div>
 </div>
 <?php
}
?>
</div>
</section>
<?php
include 'template/footer.php';

?>