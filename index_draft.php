<?php
include 'init.php';
include("template/header.php");
 if(logged_in())
	{ 
		?><div id="homepage-rgt">
            <div id="large-image"><img src="images/homepage_main_image.jpg" /></div>
            <div id="popular-pages" class="items-box">
                <h2 class="titles">Popular Pages <span style="font-size:11px;font-family: Arial,Helvetica,sans-serif;">
				<ul>
                                <li>
                    <a href="/page.php?pid=143" class="link">Photoshop</a>
                    <span>23 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                  <a href="/page.php?pid=361" class="link">Motivation pill</a>
                    <span>8 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                <a href="/page.php?pid=40" class="link">Maths haters</a>
                    <span>8 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                <a href="/page.php?pid=132" class="link">Wing Chun Kung Fu</a>
                    <span>7 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                   <a href="/page.php?pid=340" class="link">BR Logo Designers</a>
                    <span>3 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                  <a href="/page.php?pid=279" class="link">HipHop Music</a>
                    <span>3 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                   <a href="/page.php?pid=38" class="link">ARMA 3 Alpha</a>
                    <span>2 Followers</span>
                    <div class="clear"></div>
                </li>
                                <li>
                                 <a href="/page.php?pid=282" class="link">Best songs in the worl...</a>
                    <span>2 Followers</span>
                    <div class="clear"></div>
                </li>
                                </ul>
            </div>
            <div class="clear"></div>
        
		  <section id="section">
		  <div id="chat_pane">

<?php

		ini_set('display_errors', '1');
		if(!logged_in())
		{
		header('Location: index.php');
		exit();
		}
		 ?>
			  <div class ="chat">
				 <div class="messages">
								</div>
				 <textarea class="entry" placeholder="Type here and hit Return. Use Shift+Return for a new line"></textarea>
		 </div>


				 <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
				 <script src="js/chat.js"></script>

</div>
		  
		  
		  </section>
		  
		  
		  			
            <div id="recent-forum-posts" class="items-box">
                <h2 class="titles">Recent Forum Posts <span style="font-size:11px;font-family: Arial,Helvetica,sans-serif;">
				<a href="/forum/recent_activity.php">(view more)</a></span></h2>
                <ul>
                                        <li>
             <a href="/forum/topic.php?id=108" class="title-link">AJAX Chat Tutorials Source Code</a><br />
                        <a href="/profile.php?user=1297"><b>Brendon McBain</b></a>
                        <span class="date">1 hour 7 minutes ago</span>
                                                
                        <div class="clear"></div>
                    </li>
                                        <li>
                                            <a href="/forum/topic.php?id=197" class="title-link">Ajax</a><br />
                        <a href="/profile.php?user=1489"><b>Steven Azlan</b></a>
                        <span class="date">4 hours 47 minutes ago</span>
                                                
                        <div class="clear"></div>
                    </li>
                                        <li>
                                              <a href="/forum/topic.php?id=199" class="title-link">Unable to upload images (linux)</a><br />
                        <a href="/profile.php?user=1489"><b>Steven Azlan</b></a>
                        <span class="date">4 hours 48 minutes ago</span>
                                                
                        <div class="clear"></div>
                    </li>
                                        <li>
                                            <a href="/forum/topic.php?id=121" class="title-link">3 Word Story</a><br />
                        <a href="/profile.php?user=2239"><b>Pere Garau Burguera</b></a>
                        <span class="date">5 hours 11 minutes ago</span>
                                                
                        <div class="clear"></div>
                    </li>
                                        <li>
                                             <a href="/forum/topic.php?id=196" class="title-link">Getting new rows in the database and out again</a><br />
                        <a href="/profile.php?user=2035"><b>Benny Lindwall</b></a>
                        <span class="date">June 8, 2013</span>
                                                
                        <div class="clear"></div>
                    </li>
                                    </ul>                
            </div>
            
        </div>
        <div class="clear"></div> 
		</section>
        </section>        


<footer id="the_footer">
	    Copyright
	</footer>
	<div id="fixed_footer">
<ul id="footer_menu">
<li id="menuItem"><a href="index.php">Home</a></li>
<li id="menuItem"><a href="get_notes.php" >Get Notes</a></li>
<li id="menuItem"><a href="discuss.php">Forum</a></li>
<li id="menuItem"><a href="discuss.php" >About</a></li>
<li id="menuItem"><a href="contact_me.php">Contact me</a></li>
</ul>
</div>
</div>

</body>
</html>
			
			
			
			<?php
 }
 ?>