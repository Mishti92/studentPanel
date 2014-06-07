<?php
if(!logged_in()){
header('Location:index.php');
exit;
}
else
{
?>				</section>
				
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
								 <!--<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>-->
								 <script src="js/chat.js"></script>
					</div>
					<div id="recent_uploads" class="items-box">
							<h2>Recent Uploads</span></h2>
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
							<a href="get_notes.php">View more...</a>
				
					</div>
				</aside>
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
		<?php
				}
				?>
</div>

</td>
</tr>
</table>

</body>
</html>