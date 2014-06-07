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
<div id="page_head"><h3>Upload your pic:</h3></div>

<?php
if(isset($_FILES['image']))
{ $image_name =$_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_temp = $_FILES['image']['tmp_name'];

  $allowed_ext= array('jpg','jpeg','png','gif');
  $image_ext= strtolower(end(explode('.',$image_name)));

  $errors = array();

  if(empty($image_name))
  {
    $errors[]='Please select a file! ';
  }
  else
  {
    if(in_array($image_ext,$allowed_ext) === false)
    {
       $errors[]= 'File type not allowed. ';
    }

    if($image_size > 2097152)
    {
      $errors[]= 'Maximum file size is 2 MB. ';
    }
  }


  if(!empty($errors))
  {
  ?>
  <div id="error_bar"><?php
    foreach($errors as $error)
    {
	echo '<span id="error">*</span>';
      echo $error.'<br />';
    }?>
	</div><?php
  }
  else
  {
                  $user_id=$_SESSION['user_id'];
    mysql_query("UPDATE users SET pic='$image_ext' WHERE user_id=".$_SESSION['user_id']);
    $location = 'profilepic/';
    $image_file = $user_id.'.'.$image_ext;
    move_uploaded_file($image_temp,$location.$image_file);
      header('Location:show_profile.php');
      exit();
  }
  }




?>

<form action="" method="post" enctype="multipart/form-data">
<div id="forumlist_head">
<div id="forum_post">

Please select a file to upload a profile picture.
</div>
</div>

<div id="forumlist">
<div id="forum_category">
<div id="div_file"><input type="file" name="image" /></div>
</div>


<div id="forum_category">
</div>

<div id="forum_category">
</div>

<div id="forum_category">
</div>

<div id="forum_category">
</div>

<div id="forum_category">
<input id="login_button" type="Submit" value="Upload"/>
</div>

</div>


<br/> 
<p></p>
</form>
</section>
<?php
include 'template/footer.php';
?>