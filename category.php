<?php
include 'init.php';


if(!logged_in())
{
  header('Location: index.php');
  exit;
}


include 'template/header.php';



if(!isset($_GET['id']) || empty($_GET['id']))
{
header('Location: discuss.php');
exit();
}

$id=$_GET['id'];

$query=mysql_query("SELECT COUNT(category_id) FROM categories WHERE category_id='$id'");
$no=mysql_result($query , 0);

if($no == 0)
{
header('Location: discuss.php');
exit();
}

$sql=mysql_query("SELECT name FROM categories WHERE category_id='$id'");
$category_name=mysql_result($sql,0);

$topics=get_topic_by_category($id);

?>

<section id="section">

   <div id="page_head">   <h3>Category: Btech -<?php echo $category_name; ?></h3></div>
<div id='section_submit'>
 <div id="forumlist_head">
							 <div id="forum_post">Topic</div>
							 <div id="forum_category">Author</div>
							 <div id="forum_category">Last Reply</div>
							 <div id="forum_count">Replies</div>
							 </div>
							
							<?php
							if(empty($topics)){
							?>
							<div id="forumlist">
							    <div id="forum_post">There are no topics in this category.</div>
							</div>
							<?php
							}
							else
							{
							foreach($topics as $topic){
							$topic_id=$topic['topic_id'];
							$sql=mysql_query("SELECT count(reply_id) FROM replies WHERE topic_id='$topic_id'");
							$count=mysql_result($sql,0);
							
  $replies_query= mysql_query("
  SELECT reply_user_name, timestamp
  FROM  `replies`
  where `topic_id` = '$topic_id'
  ORDER BY reply_id DESC");
    
  $reply=@mysql_fetch_assoc($replies_query);

							?>
								 <div id="forumlist">
							 <div id="forum_post"><a href="topic.php?topic_id=<?php echo $topic_id; ?>"><?php echo $topic['title'];?></a></div>
							 <div id="forum_category"><a href="view_someone.php?id=<?php echo $topic['user_id']; ?>"><?php echo $topic['user_name'];?></a></div>
							 <div id="forum_category">
							 <?php
							 if(empty($reply)){
							 echo 'No reply yet.';
							 }
							 else
							 {
							 $reply_timestamp=$reply['timestamp'];
						$timezone = "Asia/Calcutta";
					if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
                $date = date('d-m-Y',$reply_timestamp);


							 echo $date; 
							 }
							 ?></div>
							 <div id="forum_count"><?php echo $count;?></div>
							 </div>
							 <?php
							
							}
													
							}
														?>

														<div id="forumlist_head">
														<div id="forum_post"></div>
														<div id="forum_category"><a href="discuss.php">Add a topic</a></div>
														</div>
</div>
   
   </section>
<?php

include 'template/footer.php';

?>