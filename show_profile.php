<?php
include 'init.php';

if(!logged_in())
{
  header('Location: index.php');
  exit;
}

include 'template/header.php';
?>
<section id="section">
<div id ="section_submit">

<?php
$user_data = user_data('email','user_name','name','course','year','roll_no','gender');
$name=$user_data['name'];
$user_name=$user_data['user_name'];
$email=$user_data['email'];
$gender=strtoupper($user_data['gender']);
$course=strtoupper($user_data['course']);
$sql=mysql_query("SELECT name FROM categories WHERE category_name='$course'");
$course_name=@mysql_result($sql,0);
$year=$user_data['year'];
$roll_no=$user_data['roll_no'];
 echo '<div id="page_head"><h3>My Profile</h3></div><br />';

?>

<div id="forumlist_head">
<div id="forum_category"><strong>Name</strong> </div>
<div id="forum_post"><?php echo $name; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Username</strong> </div>
<div id="forum_post"><?php echo $user_name; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Email</strong> </div>
<div id="forum_post"><?php echo $email; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Gender</strong> </div>
<div id="forum_post"><?php echo $gender; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Course</strong> </div>
<div id="forum_post">Btech- <?php echo $course_name; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Year</strong> </div>
<div id="forum_post"><?php echo $year; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Roll no.</strong> </div>
<div id="forum_post"><?php echo $roll_no; ?></div>
</div>


</div>

<a href="edit_profile.php"><p id="page_text"><u>Edit Your profile</u></p></a>
</section>
<?php

include 'template/footer.php';
?>