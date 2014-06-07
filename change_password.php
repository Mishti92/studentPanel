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
<div id="page_head"> <h3>Change password </h3></div>

<?php
$user_data = user_data('email','name','password');
$register_password= $user_data['password'];

if(isset($_POST['old_password'],$_POST['new_password']))
{
 $old_password=$_POST['old_password'];
 $new_password=$_POST['new_password'];
 if(empty($old_password)||empty($new_password))
 {
  ?><div id="error_bar"><?php
    echo '<span id="error">*</span>';
      echo 'Please enter a password';
    ?>
	</div><?php   
	}
 else
 {
    $old_password=md5($old_password);
    if($old_password==$register_password)
    {
      edit_password($new_password);
      header('Location: index.php');
      exit();

    }
    else
    {
  ?><div id="error_bar"><?php
    echo '<span id="error">*</span>';
      echo 'Please enter a correct password';
    ?>
	</div><?php
	}
 }
}


?>
<div id="section_submit">
     <form  action="" method="POST">
	 <div id="forumlist_head">
	 <div id="forum_category">Old Password
	 </div>
	 <div id="forum_post"><input id="page_input"  type ="password" name="old_password" maxlength="35"/>
	 </div>
	 </div>
     

<div id="forumlist_head">
	 <div id="forum_category">New Password
	 </div>
	 <div id="forum_post"><input id="page_input" type ="password" name="new_password" maxlength="35"/>
	 </div>
	 </div>

	 <div id="forumlist">
	 <div id="forum_post">
	 </div>
	 <div id="forum_category"><input id="login_button" type="submit" value ="Change"/> </div>
	 
	 </div>
	 
     </form>
</div>
</section>
 <?php

 include 'template/footer.php';

 ?>