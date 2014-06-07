<?php
include 'init.php';
if(!logged_in())
{
 header('Location:sign_up.php');
 exit;
}
?>

<!DOCTYPE html>            

<html lang="en"> 
<head>
   <meta charset="utf-8" /> 
   <title>ASP</title>
  <link rel="stylesheet" href="css/index.css" />
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.slideViewerPro.1.0.js" type="text/javascript"></script>
	
</head>
<body bgcolor="#000">

<center><div id="space"></div>
<table cellpadding="0" cellspacing="0" height="100%" border="0" bgcolor=#ccc >
	<tr>
	<td height="600" width=100% style="border: 10px groove #333333; background:url(images/grey.png) 0 0 ;">	
<div id="big_wrapper">
	<?php
		
		$user_data = user_data('name','user_name','pic','gender');
    ?>
		<section id="head_section">
			<div id="section_div">
				<aside id="left_pane">
					<div id="profile_pic">
						<?php
							if($user_data['pic'] == NULL){
								if($user_data['gender'] == 'male'){
									?>

									<a href="edit_profile.php"><img src="images/nopic.jpg" height="190" width="190" title="Change Picture"/></a>
									<?php
								}
								else{
									   ?>
									 <a href="edit_profile.php"><img src="images/nopicf.jpg" height="190" width="190" title="Change Picture"/></a>
									   <?php

								}
							}
							else{
								$user_id=$_SESSION['user_id'];
								$ext=$user_data['pic'];
								echo '<a href="edit_profile.php"><img src="profilepic/'.$user_id.'.'.$ext.'" height="190" width="190" title="Change Picture"/></a> ';
							}
							
							
										?>
					
					</div>
				
					<nav id="nav_left">
						<ul>
							  <?php echo '<p id="page_text">'.$user_data['user_name'].'</p>'; ?>
							  <li><img src="images/prof.png" width=20px height=20px/> <a href="show_profile.php">My Profile</a> </li>
							  <li><img src="images/pass.png" width=20px height=20px/> <a href="change_password.php">Change Password</a> </li>
							  <li><?php
							  $user_id=$_SESSION['user_id'];
							  $result=mysql_query("SELECT * FROM messages WHERE receiver='$user_id' AND status='unread'") or die(mysql_error());
								$num=mysql_num_rows($result);
								if($num==0){
									echo '<img src="images/inbox.png" width=20px height=20px/> <a href="messages.php">Inbox</a>';
								}
								else
								{
									echo "<img src='images/inbox.png' width=20px height=20px/> <a href='messages.php'>Inbox($num unread)</a>";
								}
							 		 
							 ?>
							 </li>
							 <li><img src="images/sent.png" width=20px height=20px/> <a href="messages_sent.php">Sent</a> </li>
							  <li><img src="images/trash.png" width=20px height=20px/> <a href="messages_trash.php">Trash</a> </li>
							  <li><img src="images/compose.png" width=20px height=20px/> <a href="messages_compose.php">Compose</a> </li>
							 							  </ul>
					</nav><nav id="nav_left">
						<ul>
							  <li><img src="images/album.png" width=20px height=20px/> <a href="create_album.php">Create an album</a> </li>
							  <li><img src="images/image.png" width=20px height=20px/> <a href ="upload_image.php">Upload image</a> </li>
							  <li><img src="images/note.jpg" width=15px height=15px/> <a href="add_doc.php">Add a document</a> </li>
							 
							  <li><img src="images/al.jpg" width=20px height=20px/> <a href="albums.php">My Albums</a> </li>
							  <li><img src="images/doc.png" width=20px height=20px/> <a href="documents.php">My Documents</a> </li>
							  </ul>
					</nav>
				</aside>
				
				<section id="small_wrapper">
				<section id="Wrap1">
		
		<section id="pane_section">
						<div class="sliderWrapper">
					<div id="templatemo_slider">
                <div id="featuredslideshow">
                    <ul> 
                        <li><img width="740" height="310" alt="Amity School Of Engineering And Technology" src="images/1.jpg" /></li> 
                        <li><img width="740" height="310" alt="Connect with friends" src="images/2.jpg" /></li> 
                        <li><img width="740" height="310" alt="Upload and Download Notes for free." src="images/3.jpg" /></li> 
                        <li><img width="740" height="310" alt="Share notes and information." src="images/4.jpg" /></li> 
                         
                    </ul> 
                </div>
                <script type="text/javascript">
                     $("div#featuredslideshow").slideViewerPro({ 
                    thumbs: 4,  
                    thumbsPercentReduction: 15, 
                    galBorderWidth: 0, 
                    galBorderColor: "#666", 
                    thumbsTopMargin: 10, 
                    thumbsRightMargin: 10, 
                    thumbsBorderWidth: 1, 
                    thumbsActiveBorderColor: "#000", 
                    thumbsActiveBorderOpacity: 0.8, 
                    thumbsBorderOpacity: 0, 
                    buttonsTextColor: "#707070", 
                    autoslide: true,  
                    typo: true 
                    });  	
                </script>
            </div>
             
		</div>
			

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
								<!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>-->
								 <script src="js/chat.js"></script>
								 
					</div>
				</aside>
			</section>

<section id="Wrap2">
<div id="index_div">
				
				<section id="footer_pane">
					<div id="pane1" style="background-image: url(images/black.jpg);">
					<h2>Participate </h2><p><h3>In a Discussion Forum</h3></p><br/>
					<p>Join discussion boards to collaborate on homework or projects. 
					Have other students answer your toughest questions.</p>
					</div>
					<div id="pane1" style="background-image: url(images/black.jpg);">
					<h2>Socialize</h2><p><h3>Get help from your classmates</h3></p><br/>
					<p>Contact your classmates for assignments, projects, question papers or just to find out whats happening in campus</p>
					</div>
					<div id="pane1" style="background-image: url(images/black.jpg);">
						<h2>Get Class Notes</h2><p><h3>Download documents specific to your class</h3></p><br />
					<p>Documents and albums are organised by course and year for easy access</p>
					</div>
				</section>
				<section id="footer_section">
						<div id="recent-forum-posts" class="items-box">
						
							<h2>Recent Forum Posts <span style="font-size:11px;font-family: Arial,Helvetica,sans-serif;"><a href="discuss.php">(view more)</a></span></h2>
							<?php
												
									$topics= get_topics();

									if(empty($topics))
									{
									  echo 'There are no topics. Add a <a href ="discuss.php">topic</a> to the discussion';
									}
									else
									{
							?>
									<ul>
							<?php
							$x=0;
									foreach($topics as $topic){
                    $topic_id=$topic['topic_id'];
                      $topic_content=$topic['topic_content'];
                      $user_id=$topic['user_id'];
                     $name=$topic['user_name'];
                     $title=$topic['title'];
                     $topic_timestamp=$topic['timestamp'];				
									
                $timezone = "Asia/Calcutta";

                if(function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
                $date = time2str($topic_timestamp);//date('d-m-Y H:i',$topic_timestamp);
				
				$data=other_user_data($user_id);
				$pic=$data['pic'];
				$gender=$data['gender'];
				?>
		
			         <li>
					 
					 <?php
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
									<img class="profileIcon" src="profilepic/<?php echo $user_id ?>.jpg" width="20px" height="30px" />
						<?php
}
?>						<b><a href="view_someone.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a></b>
									<h4><?php echo $title; ?></h4><span class="date"><?php echo $date; ?></span>
								</li> 	
								<?php
								$x++;
								if($x==3)
								{
								 break;
								}
								
								}
								}
								?>
								</ul>
							                
					</div>
				
				
					<div id="recent-posts" class="items-box">
							<h2>Recent Uploads <span style="font-size:11px;font-family: Arial,Helvetica,sans-serif;">
							<a href="get_notes.php">(view more)</a></span></h2>
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
					
				
					</div>
				
				</section>
				
				
</div>	
	</section>  
</section>		
		
				
			</div>
	    
		
		</section>    		

		<div id="fixed_footer">
			<ul id="footer_menu">
						<li id="menuItem"><a href="index.php">Home</a></li>
						<li id="menuItem"><a href="get_notes.php" >Get Notes</a></li>
						<li id="menuItem"><a href="discuss.php">Forum</a></li>
						<li id="menuItem"><a href="contact_me.php">Contact Us</a></li>
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
			
			
	


