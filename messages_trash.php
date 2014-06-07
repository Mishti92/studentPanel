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
<div id="page_head"><h3>Messages</h3></div>
<div id="messages_pane">
<a href="messages.php"><div id="page_nav">Inbox</div></a>
<a href="messages_sent.php"><div id="page_nav">Sent</div></a>
<a href="messages_trash.php"><div id="page_nav_now">Trash</div></a>
<a href="messages_compose.php"><div id="page_nav">Compose</div></a>
</div>
<div id="message_div">
<?php
	
$user_id=$_SESSION['user_id'];
$messages=get_trash_messages($user_id);
if(empty($messages))
{
echo 'There are no messages in the trash.';
}
else
{
foreach($messages as $message)
	{
		
		echo "<div id='inbox_message'>";
		$id=$message['id'];
		$receiver_id=$message['receiver'];
		$sender_id=$message['sender'];
		$subject_long=$message['subject'];
		$subject=substr($subject_long,0,30);
		$body=$message['body'];
		$date_sent=$message['date_sent'];
		$status=$message['status'];
		
		$r_query=mysql_query("SELECT name FROM users JOIN messages WHERE users.user_id=messages.receiver and messages.receiver='$receiver_id'");
		$receiver=@mysql_result($r_query,0);
		
		$s_query=mysql_query("SELECT name FROM users JOIN messages WHERE users.user_id=messages.sender and messages.sender='$sender_id'");
		$sender=@mysql_result($s_query,0);
		
		$timezone = "Asia/Calcutta";

                if(function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
                $date = time2str($date_sent);
						
		?>
		<div id="from_message">
		<?php 
			echo $sender;
			?>
		</div>
		<a href="view_message.php?id=<?php echo $id;?>">
		<div id="subject_message">
		<?php 
			echo $subject.'...';
			?>
		</div></a>
		<div id="time_message">
			<?php 
			echo $date;
			?>
		</div>
		<div id="delete_message">
	<a href='delete_message_forever.php?id=<?php echo $id; ?>'>Delete</a>
		</div>
	</div>
		<?php
		}
	
		}
		?>
</div>
</section>
<?php
include 'template/footer.php';
?>