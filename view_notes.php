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
if(empty($_GET['course']) || empty($_GET['year']))
{
  header('Location: get_notes.php');
  exit();
}
else
{
$course = $_GET['course'];
$year = $_GET['year'];

 if(notes_check($course,$year) === false)
 {
   echo '<p id="page_text"> Not valid. </p>';
   echo '<p id="page_text"><a href="get_notes.php">Go Back</a></p>';
 }

 else
 {
 $course=strtoupper($course);
$sql=mysql_query("SELECT name FROM categories WHERE category_name='$course'");
$name=@mysql_result($sql,0);
echo '<div id="page_head"><h3>Notes ('.$year.' '.$name.')</h3></div>';
?>
<div id="section_submit">
<?php
echo '<div id="forumlist_head"><div id="forum_post"><strong>Documents</strong></div></div>';

$docs = get_notes_docs($course,$year);

if(empty($docs))
{
  echo '<div id="forumlist"><div id="forum_post">There are no documents.</div></div>';
}
else
{
?>
<div id="forumlist_head">
						
							 <div id="forum_post">Name</div>
							  <div id="forum_count"></div>
							   <div id="forum_count"></div>
							 <div id="forum_category">Author</div>
							 <div id="forum_category">Date</div>
							 </div>



<?php
  foreach($docs as $doc)
  {
    $user_id=$doc['user_id'];

  $query= mysql_query("SELECT user_name FROM users WHERE user_id='$user_id'");
  $name=mysql_result($query, 0);
?>

<div id="forumlist">
						
							 <div id="forum_post"><?php echo '<a href ="docs/'.$doc['doc_id'].'.'.$doc['ext'].'">'.$doc['name'].'</a>'; ?></div>
							  <div id="forum_count">
							  <?php
							  if($user_id==$_SESSION['user_id'])
							  {
							  echo '<a href="edit_doc.php?doc_id='.$doc['doc_id'].'">Edit</a>';
							  }


?>							  
							  </div>
							   <div id="forum_count">
							   <?php
							  if($user_id==$_SESSION['user_id'])
							  {
							  echo '<a href="delete_doc.php?doc_id='.$doc['doc_id'].'">Delete</a>';
							  }


?>							  
							   </div>
							 <div id="forum_category"><?php echo '<a href=\'view_someone.php?id='.$user_id.'\'>'.$name.'</a>';?></div>
							 <div id="forum_category"><?php echo @date('d M Y / h:i',$doc['timestamp']); ?></div>
							 </div>
<?php
  }
}
?>
<div id="forumlist_head"><div id="forum_post">
</div>
<div id="forum_category"><a href="add_doc.php">Add document</a></div></div>

</div>
<div id="section_submit">
<?php



echo '<div id="forumlist_head"><div id="forum_post"><strong>Albums</strong></div></div>';

$albums= get_notes_albums($course,$year);

if(empty($albums))
{
  echo '<div id="forumlist"><div id="forum_post">There are no albums.</div></div>';

}
else
{?>

<div id="forumlist_head">
						
							 <div id="forum_post">Name</div>
							  <div id="forum_count"></div>
							   <div id="forum_count"></div>
							 <div id="forum_category">Images</div>
							
							 <div id="forum_category">Author</div>
							 <div id="forum_category">Date</div>
							  </div>


<?php
  foreach($albums as $album)
  {
  $user_id=$album['user_id'];

  $query= mysql_query("SELECT user_name FROM users WHERE user_id='$user_id'");
  $name=mysql_result($query, 0);
  
  ?>
  
<div id="forumlist">
						
							 <div id="forum_post"><?php 
     echo '<a href ="view_notes_album.php?album_id='.$album['album_id'].'&user_id='.$user_id.'">'.$album['name'].'</a>'; ?></div>
							  		  <div id="forum_count">
							  <?php
							  if($user_id==$_SESSION['user_id'])
							  {
							  echo '<a href="edit_album.php?album_id='.$album['album_id'].'">Edit</a>';
							  }


?>							  
							  </div>
							   <div id="forum_count">
							   <?php
							  if($user_id==$_SESSION['user_id'])
							  {
							  echo '<a href="delete_album.php?album_id='.$album['album_id'].'">Delete</a>';
							  }


?>							  
							   </div>
							   <div id="forum_category"><?php echo $album['count']; ?></div>
							
					<div id="forum_category"><?php echo '<a href=\'view_someone.php?id='.$user_id.'\'>'.$name.'</a>';?></div>
							 <div id="forum_category"><?php echo @date('d M Y / h:i',$album['timestamp']); ?></div>
							   </div>
  <?php
  }
}
?>


<div id="forumlist_head"><div id="forum_post">
</div>
<div id="forum_category"><a href="create_album.php">Add album</a></div></div>

</div>
<?php



 }


}
?>
</section>
<?php

include 'template/footer.php';

?>