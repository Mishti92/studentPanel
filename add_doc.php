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
<div id="page_head">
<h3>Add a document</h3></div>

<?php

if(isset($_FILES['file'],$_POST['doc_name'],$_POST['doc_course'],$_POST['doc_year']))
{
  $file_name = $_FILES['file']['name'];
  $file_size = $_FILES['file']['size'];
  $file_temp = $_FILES['file']['tmp_name'];

  $allowed_ext= array('doc','docx','pdf','ppt','pptx');
  $file_ext= strtolower(end(explode('.',$file_name)));

  $doc_name=$_POST['doc_name'];

  $doc_course= $_POST['doc_course'];
  $doc_year= $_POST['doc_year'];

  $error = 0;
?><div id="error_bar">
<?php

  if(empty($file_name)|| empty($doc_name))
  {
	echo '<span id="error">*</span>';
    echo 'Something is missing. ';
    $error = 1;
  }
  else
  {
    if(in_array($file_ext,$allowed_ext) === false)
    {
 echo '<span id="error">*</span>';
 echo 'File type not allowed. ';
       $error = 1;
    }

    if($file_size > 5242880)
    {
echo '<span id="error">*</span>';      echo 'Maximum file size is 5 MB. ';
      $error = 1;
    }

  }
?> </div>
<?php
  if($error == 0)
  {

    upload_doc($file_temp,$file_ext,$doc_name,$doc_course,$doc_year);
    header('Location: documents.php');
    exit();
  }


}

  ?>
 

<div id="section_submit">
<form action="" method="POST" enctype="multipart/form-data">

<div id="forumlist_head">
<div id="forum_category"><strong>Choose file</strong> </div>
<div id="forum_post"><div id="div_file"><input type="file" name="file"/></div></div>
</div>


<div id="forumlist_head">
<div id="forum_category"><strong>Name</strong> </div>
<div id="forum_category"> </div>
<div id="forum_count"> </div>
<div id="forum_post"><input id="page_input" type="text" name="doc_name"/></div>
</div>

<div id="forumlist_head">
<div id="forum_category"><strong>Course</strong> </div>
<div id="forum_category"> </div>
<div id="forum_count"> </div>
<div id="forum_post">
 <select id="page_input" name ="doc_course">
 
 
 <?php $sql = "SELECT * FROM  `categories`;";
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
<div id="forum_category"> </div>
<div id="forum_count"> </div>
<div id="forum_post"><select id="page_input" name ="doc_year">
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
         </select>
</div>
</div>


<div id="forumlist">
<div id="forum_post"></div>
<div id="forum_category"><input id="login_button" type="submit" value="Upload"/></div>
</div>
</form>
</div>


</section>
  <?php

include 'template/footer.php';
?>