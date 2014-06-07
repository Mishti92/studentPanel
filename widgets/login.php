<?php
if(!logged_in()){
header('Location:index.php');
exit;
}
else
{	
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
				
				<section id="pane_section">
				<?php
}
?>