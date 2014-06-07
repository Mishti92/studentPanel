<?php
include 'init.php';
if(!logged_in())
{
header('Location: index.php');
exit();
}

if(isset($_POST['get_course'],$_POST['get_year']))
{
$course=$_POST['get_course'];
$year=$_POST['get_year'];

header('Location: view_notes.php?course='.$course.'&year='.$year.'');
exit();

}

include 'template/header.php';
?>
<section id="section">
<div id="page_head">
<h3>Get Notes</h3></div>

<form action="" method="Post">

<div id="section_submit">
<div id="forumlist_head">
<div id="forum_post">
Select the following details:</div>
</div>

<div id="forumlist_head">
<div id="forum_category">Course:
</div>
<div id="forum_post"><select id="page_input" name ="get_course">
                   
				   <?php $sql = "SELECT * FROM  `categories`;";
                             $rsd = mysql_query($sql);
                             while($rs = mysql_fetch_array($rsd)) {
	                        $category_id = $rs['category_id'];
							$category_name = $rs['category_name'];
$name=$rs['name'];
							echo "<option value=\"$category_name\">Btech - $name</option>";
							}
 ?>
				   
				   </select>
</div>
</div>



<div id="forumlist_head">
<div id="forum_category">Year:
</div>
<div id="forum_post"><select id="page_input" name ="get_year">
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
         </select>
</div>
</div>
<?php


  
?>
<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category">
<input id="login_button" type ="submit" value="Get Notes">
</div>
</div>


</form>
</div>
</section>
<?php
include 'template/footer.php';

?>
