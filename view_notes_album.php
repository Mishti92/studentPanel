<?php
include 'init.php';
if(!logged_in())
{
  header('Location: index.php');
  exit();
}

include 'template/header.php';
?>
<section id="section">
<?php
if(!isset($_GET['album_id']) || empty($_GET['album_id']) || !isset($_GET['user_id']) || empty($_GET['user_id']))
{
  header('Location: get_notes.php');
  exit();
}
$album_id=$_GET['album_id'];
$user_id=$_GET['user_id'];

/*
$album_data = album_data($album_id,'name','description','course','year');*/
$query= mysql_query("SELECT name, description, course, year FROM albums WHERE album_id='$album_id' AND user_id='$user_id'");
$album_data=mysql_fetch_assoc($query);
  
echo '<div id="page_head"><h3>'.$album_data['name'].'</h3></div>';
echo '<div id="section_submit">';
echo '<div id="forumlist_head"><div id="forum_post">'.$album_data['description'].'</div></div>';
echo '<div id="forumlist_head"><div id="forum_post">'.$album_data['year'].' '.$album_data['course'].'</div></div>';


$images = get_notes_images($album_id,$user_id);


if(empty($images))
{
  echo '<div id="forumlist"><div id="forum_category"></div><div id="forum_post">There are no images in this album.';

  if (album_check($_GET['album_id']) === false)
  {
   echo '</div></div>';
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
    <img src="uploads/thumbs/'.$image['album'].'/'.$image['id'].'.'.$image['ext'].'" title="Uploaded '. @date('d M Y / h:i',$image['timestamp']).'">
    </a>';
    echo '&nbsp;';
  }
  echo '</div>';
  echo '<div id="forumlist_head">';
  echo '<div id="forum_post">';
echo '</div>';
echo '<div id="forum_category">';

if (album_check($_GET['album_id']) === false)
  {
   echo '';
  }
  else
  {
    echo '<a href="upload_image.php"> Add images </a>';
  }

echo '</div>';
echo '</div>';
}
?>
</div>

</section>
<?php
include 'template/footer.php';

?>