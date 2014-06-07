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

if(message_sent_check($id)== 0)
{
header('Location: messages_sent.php');
exit();
}

 $messages=message_data($id);
 
                      $receiver=$messages['receiver'];
					  $query=mysql_query("SELECT user_name FROM users WHERE user_id='$receiver'");
					  $receiver_name=mysql_result($query,0);
                      $body=$messages['body'];
                      $subject=$messages['subject'];
                      $status=$messages['status'];
                     $message_timestamp=$messages['date_sent'];				
									
                $timezone = "Asia/Calcutta";

                if(function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
                $date =date('d-m-Y',$message_timestamp);
		
 
 ?>

 
 
<section id="section">
<div id="page_head"><h3>View Messages</h3></div>
<div id="message_div">
<div id="forumlist_head"> 
<div id="forum_post">To:&nbsp;<a href="view_someone.php?id=<?php echo $receiver;?>" >
	<?php echo $receiver_name; ?></a></div>
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
<div id="forum_category"><a href="messages_compose.php?to=<?php echo $receiver_name; ?>">Message</a></div>
</div>


</div>
</section>
 
<?php
include 'template/footer.php';
?>
?>