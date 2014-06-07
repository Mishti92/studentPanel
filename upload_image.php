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
<div id="page_head"><h3>Upload image</h3></div>

<?php

if(isset($_FILES['image'],$_POST['album_id']))
{
 $files=$_FILES['image'];

 for($x=0;$x< count($files['name']); $x++)
 {
  $image_name = $files['name'][$x];
  $image_size = $files['size'][$x];
  $image_temp = $files['tmp_name'][$x];

  $allowed_ext= array('jpg','jpeg','png','gif');
  $image_ext= strtolower(end(explode('.',$image_name)));

  $album_id=$_POST['album_id'];

  $errors = array();

  if(empty($image_name)|| empty($album_id))
  {
    $errors[]='Both file and album name required.';
  }
  else
  {
    if(in_array($image_ext,$allowed_ext) === false)
    {
       $errors[]= 'File type not allowed. ';
    }

    if($image_size > 6291456)
    {
      $errors[]= 'Maximum file size is 6 MB. ';
    }

    if(album_check($album_id) === false )
    {
       $errors[]= 'Couldn\'t upload to that album';
    }

  }


  if(!empty($errors))
  {
  ?><div id="error_bar"><?php
    foreach($errors as $error)
    {
	echo '<span id="error">*</span>';
      echo $error.'<br />';
    }?>
	</div><?php
  }
  else
  {
    upload_image($image_temp,$image_ext,$album_id);
    if($x+1 == count($files['name']))
    {
      header('Location: view_album.php?album_id='.$album_id);
      exit();
  }
  }

 }
}

$albums = get_albums();
if(empty($albums))
{
  echo '<p id="page_text">You don\'t have any albums. <a href="create_album.php">Create an album</a></p>';

}
else
{
  ?>

<div id="section_submit">

<form action="" method="POST" enctype="multipart/form-data">
    
<div id="forumlist_head">
<div id="forum_post"><strong>Choose a file</strong> </div>
<div id="forum_post"><div id="div_file">
	 <input  type="file" name="image[]" id="page_file" multiple/></div>
     </div>
</div>

<div id="forumlist_head">
<div id="forum_post"><strong>Choose an album</strong> </div>
<div id="forum_category"></div>
<div id="forum_post">
       <select id="page_input" name ="album_id">
                  <?php
                    foreach($albums as $album)
                    {
                     echo '<option value="'.$album['id'].'">'.$album['name'].'</option>';
                    }
                  ?>
       </select>
</div>
</div>
<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category"><input id="login_button" type="submit" value="Upload"/>
</div>
 
</div>
</form>
</div>
  <?php
  }
?>
</section>
<?php
include 'template/footer.php';
?>