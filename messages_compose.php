<?php
include 'init.php';

?><!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ASP</title>

  <link rel='stylesheet' type='text/css' href='css/index.css'>
  </head>
<body>
 
<body bgcolor="#000">

<center><div id="space"></div>

<table cellpadding="0" cellspacing="0" height="100%" border="0" bgcolor=#ccc >
	<tr>
	<td height="600" style="border: 10px groove #333333; background:url(images/grey.png) 0 0 ;">	
<div id="big_wrapper">
<?php include("widgets/login.php"); ?>


<section id="section">
<div id="page_head"><h3>Messages</h3></div>
<div id="messages_pane">
<a href="messages.php"><div id="page_nav">Inbox</div></a>
<a href="messages_sent.php"><div id="page_nav">Sent</div></a>
<a href="messages_trash.php"><div id="page_nav">Trash</div></a>
<a href="messages_compose.php"><div id="page_nav_now">Compose</div></a>
</div>
<div id="message_div">

<div id="error_bar">
<?php
if(isset($_GET['to'])&&!empty($_GET['to']))
{
$to=$_GET['to'];
}
if(isset($_POST['search_text'],$_POST['subject'],$_POST['body'])){
	$receiver=$_POST['search_text'];
	$subject=$_POST['subject'];
	$body=$_POST['body'];
	$errors=array();
	if(empty($receiver)||empty($subject)||empty($body))
	{
		$errors[]='Please fill in all the fields';
	}
	else
	{
	if(self_message($receiver)=== false){
		$errors[]='You cant send message to yourself';
	}
	if(username_exists($receiver)=== false)
	{
		$errors[]='Please enter a correct username';
	}
	}
	if(!empty($errors))
						{
						  foreach($errors as $error)
						  {
						  
						  ?>
						  
				<span id="error">*</span>
						  <?php
							echo $error.'&nbsp;&nbsp;';
						  }
						}
						else
						{
							send_message($receiver,$subject,$body);
							header('Location:messages_sent.php');
							exit();
													}
						

}



?>
</div>
<form id="search" name="search" action="" method="post">


<div class="ui-widget">
<p id="page_text">   To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<input id="tags" type="text" name="search_text" value="<?php echo $to; ?>" onkeyup="findmatch()"/>
</p></div>

<p id="page_text">Subject&nbsp;&nbsp;&nbsp;<input id="message_input" type="text" name="subject" /></p>
	<p id="page_text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;<textarea id="message_des" type="text" name="body" /></textarea></p>
	<input id="login_button" type="submit" value="Send" />
</form>
</div>

				</section>
				</section>
				
				<aside id="right_pane">
					<div id="chat_pane">
						<?php
							ini_set('display_errors', '1');
							if(!logged_in())
							{
							header('Location: sign_up.php');
							exit();
							}
						?>
							<div class ="chat">
									 <div class="messages">
									</div>
									 <textarea class="entry" placeholder="Type here and hit Return. Use Shift+Return for a new line"></textarea>
							</div>
							<script src="js/script.js"></script>
							<script src="js/chat.js"></script>
							
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   
 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
  <script>
  $(function() {
    var availableTags = [
      <?php

		$query=mysql_query("SELECT user_name FROM users");
		while($user_row=mysql_fetch_assoc($query))
  {
    $users[] = array(
                      'user_name' => $user_row['user_name'],
                      );
   }

		foreach($users as $user){
		echo '"'.$user['user_name'].'",';
		}?>
	  ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
  </script>

					</div>
					
					
					<div id="recent_uploads" class="items-box">
							<h2>Recent Uploads</h2>
							<?php
									
						

  $albums=array();

  $albums_query=mysql_query("SELECT * FROM albums ORDER BY album_id DESC
  ");

						
  while($albums_row=@mysql_fetch_assoc($albums_query))
  {
    $albums[]= array(
                'album_id' => $albums_row['album_id'],
                'user_id' => $albums_row['user_id'],
                'timestamp' => $albums_row['timestamp'],
                'name' => $albums_row['name'],
                'description' => $albums_row['description'],
                'course' => $albums_row['course'],
                'year' => $albums_row['year'],
    );
  }
  $docs=array();

  $docs_query=mysql_query("SELECT * FROM documents ORDER BY doc_id DESC
  ");

						
  while($docs_row=@mysql_fetch_assoc($docs_query))
  {
    $docs[]= array(
                'doc_id' => $docs_row['doc_id'],
                'user_id' => $docs_row['user_id'],
                'timestamp' => $docs_row['timestamp'],
                'name' => $docs_row['name'],
                'course' => $docs_row['course'],
                'year' => $docs_row['year'],
    );
  }
  
									
								if(empty($albums)&& empty($docs)){
								 echo 'No uploads.';
								}	
								else{
								$x=0;
								echo '<ul>';
								foreach($albums as $album){
echo '<li>';								
								$timezone = "Asia/Calcutta";

                if(function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
				$course=strtoupper($album['course']);
				$year=$album['year'];
                $date = time2str($album['timestamp']);
				$user_id=$album['user_id'];
				
				$sql=mysql_query("SELECT user_name FROM users WHERE user_id='$user_id'");
				$name=mysql_result($sql,0);
				
				$data=other_user_data($user_id);
				$pic=$data['pic'];
				$gender=$data['gender'];
				if($pic==NULL){
					 if($gender=='male'){
						echo '<img class="profileIcon" src="images/nopic.jpg" width="20px" height="30px" />';
					 }
					 else{
						echo '<img class="profileIcon" src="images/nopicf.jpg" width="20px" height="30px" />';
				 		 }
					 
					 }
					 else
					 {
				
									?>
									<img class="profileIcon" src="profilepic/<?php echo $user_id ?>.jpg" width="30px" height="30px" />
									<?php
									}
									?><b><a href="view_someone.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a> (<?php echo $year.' Btech-'.$course;?>)</b>
									<h4><a href="view_notes_album.php?album_id=<?php echo $album['album_id'];?>&user_id=<?php echo $album['user_id']; ?>"><?php echo $album['name']; ?></a></h4><span class="date"><?php echo $date; ?></span>
								<?php	
									$x++;
									echo '</li>';
									if($x==1)
									break;								
									}
								$y=0;
								foreach($docs as $doc){
									$timezone = "Asia/Calcutta";
echo '<li>';
                if(function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
                $date = time2str($doc['timestamp']);
				$user_id=$doc['user_id'];
				
				$course=strtoupper($doc['course']);
				$year=$doc['year'];
				$sql=mysql_query("SELECT user_name FROM users WHERE user_id='$user_id'");
				$name=mysql_result($sql,0);
				
			$data=other_user_data($user_id);
				$pic=$data['pic'];
				$gender=$data['gender'];
										
										if($pic==NULL){
					 if($gender=='male'){
						echo '<img class="profileIcon" src="images/nopic.jpg" width="20px" height="30px" />';
					 }
					 else{
						echo '<img class="profileIcon" src="images/nopicf.jpg" width="20px" height="30px" />';
				 		 }
					 
					 }
					 else
					 {
				
									?>
									<img class="profileIcon" src="profilepic/<?php echo $user_id ?>.jpg" width="30px" height="30px" />
									<?php
									}
									?>


				<b><a href="view_someone.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a> (<?php echo $year.' Btech-'.$course;?>) </b>
									<h4><?php echo $doc['name']; ?></h4><span class="date"><?php echo $date; ?></span>
								<?php	
									$y++;
									echo '</li>';
									if($y==2)
									break;								
									}
								echo '</ul>';
								}
								?>
					<span style="font-size:11px;font-family: Arial,Helvetica,sans-serif;">
							<a href="get_notes.php">View more...</a></span>
				
					</div>
				</aside>
			</div>	
		</section>    
		

		<div id="fixed_footer">
<ul id="footer_menu">				
						<li id="menuItem"><a href="index.php">Home</a></li>
						<li id="menuItem"><a href="get_notes.php" >Get Notes</a></li>
						<li id="menuItem"><a href="discuss.php">Forum</a></li>
						<li id="menuItem"><a href="contact_me.php">Contact me</a></li>
						<li id="menuItem"><a href="logout.php" >Logout</a></li>
					</ul>
					
		
					<div id="logo_header">
					<img src="images/logo/1.png" width=30 height=30 />
					Amity <span id="logo_span">StudentPanel</span>
		</div>
		</div>
		
		
		
		</div>

</td>
</tr>
</table>

</body>
</html>