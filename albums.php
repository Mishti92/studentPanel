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
<div id="page_head"><h3>Albums</h3></div>
<div id="section_submit">
<?php

$albums =get_albums();
if(empty($albums))
{
  echo '<div id="forumlist_head"><div id="forum_post">You don\'t have any albums. <a href="create_album.php">Create an album</a></div></div>';

}
else
{
?>
<div id="forumlist_head">
							 <div id="forum_category">Name</div>
							 <div id="forum_post">Desciption</div>
							 <div id="forum_count"></div>
							 <div id="forum_count"></div>
							  <div id="forum_count">Images</div>
							 </div>
							 
<?php
  foreach($albums as $album)
  {
  
  
  ?>

<div id="forumlist">
							 <div id="forum_category"><a href ="view_album.php?album_id=<?php echo $album['id']; ?>"><?php echo $album['name']; ?>
							 </a></div>
							 <div id="forum_post"><?php echo $album['description']; ?></div>
							 <div id="forum_count"><a href="edit_album.php?album_id=<?php echo $album['id']; ?> ">Edit</a></div>
							 <div id="forum_count"><a href="delete_album.php?album_id=<?php echo $album['id']; ?>">Delete</a></div>
							  <div id="forum_count"><?php echo $album['count']; ?></div>
							 </div>
							 
  <?php
       }

?>

 
<div id="forumlist_head">
						
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"><a href="create_album.php">Add an album</a></div>
							 </div>
 

<?php


}
?>
</div>
</section>
<?php
include 'template/footer.php';
?>