<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit();
}

include 'template/header.php';
if(!isset($_GET['id']) || empty($_GET['id']))
{
header('Location: messages.php');
exit();
}

$id=$_GET['id'];


$query=mysql_query("SELECT COUNT(id) FROM messages WHERE id=$id");
$no=mysql_result($query , 0);

if($no == 0)
{
header('Location: messages.php');
exit();
}

if(message_check($id)== 0)
{
header('Location: messages.php');
exit();
}

 $messages=message_data($id);
 
                      $sender=$messages['sender'];
					  $query=mysql_query("SELECT user_name FROM users WHERE user_id='$sender'");
					  $sender_name=mysql_result($query,0);
                      $body=$messages['body'];
                      $subject=$messages['subject'];
                      $status=$messages['status'];
                     $message_timestamp=$messages['date_sent'];				
									
                $timezone = "Asia/Calcutta";

                if(function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
                $date =date('d-m-Y',$message_timestamp);
		
		
		if($status=='unread'){
		mysql_query("UPDATE messages SET status='read' WHERE id='$id'");
		
		}
 
 ?>

<section id="section">
<div id="page_head"><h3>View Messages</h3></div>
<div id="message_div">
<div id="forumlist_head"> 
<div id="forum_post">From:&nbsp;<a href="view_someone.php?id=<?php echo $sender;?>" >
	<?php echo $sender_name; ?></a></div>
<div id="forum_category"><?php echo $date; ?></div>

</div>

<div id="forumlist_head">
<div id="forum_post">Subject:&nbsp;<?php echo $subject; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_post">Message:</div>
</div>
<div id="forumlist_head">
<div id="forum_post"><?php echo $body; ?></div>
</div>
<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category"><a href="messages_compose.php?to=<?php echo $sender_name; ?>">Reply</a></div>
</div>


</div>
</section>
<?php
include 'template/footer.php';
?>