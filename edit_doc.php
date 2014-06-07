<?php
include 'init.php';
if(!logged_in())
{
header('Location: index.php');
exit();
}
if(!isset($_GET['doc_id']) || empty($_GET['doc_id']) || doc_check($_GET['doc_id'])===false)
{
  header ('Location: documents.php');
  exit;
}


include 'template/header.php';
?>
<section id="section">
<div id="page_head"><h3>Edit Document</h3></div>

<?php
$doc_id=$_GET['doc_id'];
$doc_data= doc_data($doc_id,'name');
$doc_course= $_POST['doc_course'];
$doc_year= $_POST['doc_year'];
if(isset($_POST['doc_name']))
{
$doc_name= $_POST['doc_name'];

$errors=array();

if(empty($doc_name))
{
  $errors[]='Document name required. ';

}
else
{
  if(strlen($doc_name)>55)
  {
    $errors[]='One or more fields contains too many chracters';
  }

}

if(!empty($errors))
{?>
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
  edit_doc($doc_id,$doc_name,$doc_course,$doc_year);
  header('Location: documents.php');
  exit();
}

}




?>
<div id="section_submit">
 <form action="?doc_id=<?php echo $doc_id; ?>" method="POST" >
 

<div id="forumlist_head">
<div id="forum_category"><strong>Name</strong> </div>
<div id="forum_post"><input id="page_input" type="text" name="doc_name" value ="<?php echo $doc_data['name']; ?>"/></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Course</strong> </div>
<div id="forum_post"> <select id="page_input" name ="doc_course"><?php $sql = "SELECT * FROM  `categories`;";
                             $rsd = mysql_query($sql);
                             while($rs = mysql_fetch_array($rsd)) {
	                        $category_id = $rs['category_id'];
							$category_name = $rs['category_name'];

							echo "<option value=\"$category_name\">Btech - $category_name</option>";
							}
 ?>
       </select>
 
</div>
</div>
 
 <div id="forumlist_head">
<div id="forum_category"><strong>Year</strong> </div>
<div id="forum_post">  <select id="page_input" name ="doc_year">
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
         </select>
 
</div>
</div>



<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category"><input id="login_button" type="submit" value="Save"/> 
</div>
</div>
 
 </form>

</div>


</section>
<?php
include 'template/footer.php';

?>