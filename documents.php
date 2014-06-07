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
<div id="section_submit">
<?php
echo '<div id="page_head"><h3>Documents</h3></div>';

$docs = get_docs();
if(empty($docs))
{
  echo '<div id="forumlist_head"><div id="forum_post">You have no documents. <a href="add_doc.php">Add a document</a></div></div>';
}
else
{?>

<div id="forumlist_head">
						
							 <div id="forum_post">Name</div>
							  <div id="forum_count"></div>
							   <div id="forum_count"></div>
							 <div id="forum_category">Date</div>
							<div id="forum_count">Course</div>
							 </div>
	<?php
  foreach($docs as $doc)
  {
  ?>

<div id="forumlist">
						
							 <div id="forum_post"><a href ="docs/<?php echo $doc['id']; ?>.<?php echo $doc['ext']; ?>"><?php echo $doc['name']; ?></a></div>
							  <div id="forum_count"><a href ="edit_doc.php?doc_id=<?php echo $doc['id']; ?>"> Edit</a></div>
							  <div id="forum_count"><a href ="delete_doc.php?doc_id=<?php echo $doc['id']; ?>" title="Delete">Delete</a></div>
							   
							 <div id="forum_category"><?php echo @date('d M Y / h:i',$doc['timestamp']); ?></div>
							<div id="forum_count"><?php echo $doc['year'].' '.$doc['course']; ?></div>
							 </div>
  <?php
  
   
  }?>
  
<div id="forumlist_head">
						
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"></div>
							 <div id="forum_post"><a href="add_doc.php">Add a document.</a></div>
							 </div>
  <?php
  }
?>
</div>
</section>
<?php
include 'template/footer.php';

?>