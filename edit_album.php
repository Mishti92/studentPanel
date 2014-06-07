<?php
include 'init.php';
if(!logged_in())
{
header('Location: index.php');
exit();
}
if(!isset($_GET['album_id']) || empty($_GET['album_id']) || album_check($_GET['album_id'])===false)
{
  header ('Location: albums.php');
  exit;
}


include 'template/header.php';
?>
<section id="section">

<div id="page_head"><h3>Edit Album</h3></div>

<?php
$album_id=$_GET['album_id'];
$album_data= album_data($album_id,'name','description');
$album_course= $_POST['album_course'];
  $album_year= $_POST['album_year'];
if(isset($_POST['album_name'],$_POST['album_description']))
{
$album_name= $_POST['album_name'];
$album_description= $_POST['album_description'];

$errors=array();

if(empty($album_name)|| empty ($album_description))
{
  $errors[]='Album name and description required. ';

}
else
{
  if(strlen($album_name)>55||strlen($album_description)>255)
  {
    $errors[]='One or more fields contains too many chracters';
  }

}

if(!empty($errors))
{ 
?>
<div id="error_bar">
<?php
	foreach($errors as $error)
	  {
	 ?>
	<span id="error">*</span>
	 <?php
	echo $error.'&nbsp;&nbsp;';
	 }
	 ?>
	 </div>
	 <?php
}
else
{
  edit_album($album_id,$album_name,$album_description,$album_course,$album_year);
  header('Location: albums.php');
  exit();
}

}




?>
<div id="section_submit">
<form action="?album_id=<?php echo $album_id; ?>" method="POST">

<div id="forumlist_head">
<div id="forum_category"><strong>Name</strong> </div>
<div id="forum_post"><input id="page_input" type ="text" name="album_name" maxlength="55" value="<?php echo $album_data['name'];?>"/>
</div>
</div>



<div id="forumlist_head">
<div id="forum_category"><strong>Description</strong> </div>
<div id="forum_post"> <textarea id="page_des" name="album_description" rows="6" cols="35" maxlength="255"/><?php echo $album_data['description']; ?> </textarea></div>
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
<div id="forum_category"><input  id="login_button" type ="submit" value="Save"/></div>

</div>

</form>
</div>
</section>
<?php
include 'template/footer.php';

?>