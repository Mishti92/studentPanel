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
header('Location: home.php');
exit();
}

$id=$_GET['id'];

$query=mysql_query("SELECT COUNT(user_id) FROM users WHERE user_id=$id");
$no=mysql_result($query , 0);

if($no == 0)
{
header('Location: home.php');
exit();
}

$user_id=$_SESSION['user_id'];

if($id==$user_id)
{
header('Location: show_profile.php');
exit();
}

$user_data=other_user_data($id);
$user_name=$user_data['user_name'];
$name=$user_data['name'];
$email=$user_data['email'];
$pic=$user_data['pic'];
$gender=strtoupper($user_data['gender']);
$course=$user_data['course'];
$year=$user_data['year'];
$roll_no=$user_data['roll_no'];

?>

<section id="section">



<div id="page_head"><h3><?php echo $name; ?></h3></div><br />

<div id="section_submit">

<div id="forumlist_head">
<div id="forum_post"></div>
<div id="forum_post"><section id="block2">

<?php
if($user_data['pic'] == NULL){
								if($user_data['gender'] == 'male'){
									?>

									<img src="images/nopic.jpg" height="150" width="150" title="<?php echo $user_name?>"/>
									<?php
								}
								else{
									   ?>
									 <img src="images/nopicf.jpg" height="150" width="150" title="<?php echo $user_name?>"/>
									   <?php

								}
							}
							else{
								$ext=$user_data['pic'];
								echo '<img src="profilepic/'.$id.'.'.$ext.'" height="150" width="150" title="'.$user_name.'"/>';
							}
							

?>


</section>
</div></div>




<div id="forumlist_head">
<div id="forum_category"><strong>Username</strong> </div>
<div id="forum_post"><?php echo $user_name; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Email</strong> </div>
<div id="forum_post"><?php echo $email; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Full name</strong> </div>
<div id="forum_post"><?php echo $name; ?></div>
</div>


<div id="forumlist_head">
<div id="forum_category"><strong>Gender</strong> </div>
<div id="forum_post"><?php echo $gender; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Course</strong> </div>
<div id="forum_post">Btech- <?php echo strtoupper($course); ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Year</strong> </div>
<div id="forum_post"><?php echo $year; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Roll no.</strong> </div>
<div id="forum_post"><?php echo $roll_no; ?></div>
</div>

<div id="forumlist">
<div id="forum_post">
</div>
<div id="forum_category"><a href="messages_compose.php?to=<?php echo $user_name;?>">Message </a><?php echo $user_name;?></div>
</div>

</div>
</section>
<?php
include 'template/footer.php';
?>