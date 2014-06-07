<?php

include 'init.php';

if(!logged_in())
{
header('Location: index.php');
exit();
}
include 'template/header.php';


?>
<section id="section">
<div id="page_head"><h3>Create Album </h3></div>
<div id="forumlist_head">
<div id="forum_post">
Please enter the details about the album, the year and the course for which the album is applicable..
</div>
</div>
<?php
if(isset($_POST['album_name'],$_POST['album_description'],$_POST['album_course'],$_POST['album_year']))
{
  $album_name= $_POST['album_name'];
  $album_description= $_POST['album_description'];
  $album_course= $_POST['album_course'];
  $album_year= $_POST['album_year'];
  $errors=array();

  if(empty($album_name)||empty($album_description))
  {
  $errors[]='Album name and description required.';
  }
  else
  {
  if(strlen($album_name)>55||strlen($album_description)>255)
  {
  $errors[]= 'One or more fields contain too many characters. ';
  }
  }

  if(!empty($errors))
  {
  ?>
  <div id="error_bar"><?php
  
    foreach($errors as $error)
    {
	echo '<span id="error">*</span>';
	echo $error.'<br/>';
    }?>
</div><?php
  }
  else
  {
    create_album($album_name,$album_description,$album_course,$album_year);
    header('Location: albums.php');
  }
}



?>

<form action ="" method = "POST">

<div id="section_submit">

<div id="forumlist_head">
<div id="forum_category"><strong>Name</strong> </div>
<div id="forum_post"><input id="page_input" type ="text" name="album_name" maxlength="55"></div>
</div>



<div id="forumlist_head">
<div id="forum_category"><strong>Description</strong> </div>
<div id="forum_post"><textarea id="page_des" name="album_description" rows="6" cols="35" maxlength="255"> </textarea></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Course</strong> </div>
<div id="forum_post"><select id="page_input" name ="album_course"><?php $sql = "SELECT * FROM  `categories`;";
                             $rsd = mysql_query($sql);
                             while($rs = mysql_fetch_array($rsd)) {
	                        $category_id = $rs['category_id'];
							$category_name = $rs['category_name'];

							echo "<option value=\"$category_name\">Btech - $category_name</option>";
							}
 ?>
       </select></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Year</strong> </div>
<div id="forum_post"><select id="page_input" name ="album_year">
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
         </select></div>
</div>


<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category"><input id="login_button" type ="submit" value="Create"></div>

</div>
</div>
</form></section>
<?php

include 'template/footer.php';
?>