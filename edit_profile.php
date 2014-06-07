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


<div id="page_head"><h3>Edit Your Profile </h3></div>


<?php
$user_data = user_data('email','user_name','name','roll_no');

if (isset($_POST['edit_name'],$_POST['edit_username'],$_POST['edit_course'],$_POST['gender'],$_POST['edit_year'],$_POST['roll_no']))
{

$edit_name=$_POST['edit_name'];
$edit_username=$_POST['edit_username'];
$roll_no=$_POST['roll_no'];
$edit_course=$_POST['edit_course'];
$edit_year=$_POST['edit_year'];
$gender=$_POST['gender'];


$errors = array();

    if(empty($edit_name)||empty($edit_username)||empty($edit_course)||empty($gender)||empty($edit_year) || empty($roll_no))
    {
      $errors[] ='All fields required';
    }
    else if(strlen($edit_name)>35)
      {
        $errors[]='Name cant have more than 35 characters. ';
      }
	  else if(edit_username_exists($edit_username) === true )
		 {
		 $errors[]='Username not available';
		 }

if(!empty($errors))
{?>
<div id="error_bar">
<?php
  foreach($errors as $error)
  {
	echo '<span id="error">*</span>';
    echo $error.' <br />';
  }
  ?>
  </div>
  <?php
}


else
{     echo $gender;
  mysql_query("UPDATE users
  SET gender='$gender' WHERE user_id=".$_SESSION['user_id']);
  
  $edit = user_edit($edit_name,$edit_username,$edit_course,$edit_year,$roll_no);
  header('Location: show_profile.php');
  exit();
}



}


?>

<form action ="" method ="POST">
<div id="section_submit">

<div id="forumlist_head">
<div id="forum_category"><strong>Email</strong> </div>
<div id="forum_post">&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $user_data['email']; ?></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Full name</strong> </div>
<div id="forum_post"><input id="page_input" type ="text" name="edit_name" maxlength="35" value="<?php echo $user_data['name']; ?>"/></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Username</strong> </div>
<div id="forum_post"><input id="page_input" type ="text" name="edit_username" maxlength="35" value="<?php echo $user_data['user_name']; ?>"/></div>
</div>


<div id="forumlist_head">
<div id="forum_category"><strong>Gender</strong> </div>
<div id="forum_post">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Male:<input type="radio" name="gender" value="male"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Female:<input type="radio" name="gender" value="female"/> 
 </div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Course</strong> </div>
<div id="forum_post"><select id="page_input" name ="edit_course">
                   
<?php $sql = "SELECT * FROM  `categories`;";
                             $rsd = mysql_query($sql);
                             while($rs = mysql_fetch_array($rsd)) {
	                        $category_id = $rs['category_id'];
							$category_name = $rs['category_name'];
$name=$rs['name'];
							echo "<option value=\"$category_name\">Btech - $name</option>";
							}
 ?>

				   </select></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Year</strong> </div>
<div id="forum_post"><select id="page_input" name ="edit_year">
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
         </select></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Roll no.</strong> </div>
<div id="forum_post"><input id="page_input" type ="text" name="roll_no" maxlength="15" value="<?php echo $user_data['roll_no']; ?>" /></div>
</div>
<div id="forumlist_head">
<div id="forum_post">To Change Profile Picture , <a href="upload_pic.php">Click here</a></div>
</div>
<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category"><input id="login_button" type="submit" value ="Save"/> </div>
</div>

</div>
</form>

</section>

<?php

include 'template/footer.php';

?>