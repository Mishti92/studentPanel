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

   <div id="page_head">   <h3>Discussion Forum:</h3></div>
<?php

if(isset($_POST['topic']))
    {

    $topic = $_POST['topic'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $user_id= $_SESSION['user_id'];
    $name=$_POST['name'];
    if(empty($topic) || empty($name)|| empty($title))
    {
	echo '<div id="error_bar">';
      echo 'Something is missing </div>';
    }
    else
    {
    $sql = "INSERT into topics VALUES ('', '$topic', '$category_id','$user_id', UNIX_TIMESTAMP(),'$name','$title') ";
      $rsd = mysql_query($sql);
    header('Location: discuss.php');
    exit();
    }


    }


 ?>

  <form action="" method="post" name="topic_form">
  <p id="page_text">Name: <input id="page_input" type="text" name="name" maxlength="35"
  value="<?php $user_data = user_data('user_name'); echo $user_data['user_name']; ?>" />
  &nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;Category: <select id="page_input" name="category_id">
  <?php $sql = "SELECT * FROM  `categories`;";
                             $rsd = mysql_query($sql);
                             while($rs = mysql_fetch_array($rsd)) {
	                        $category_id = $rs['category_id'];
							$category_name = $rs['category_name'];
$name=$rs['name'];
							echo "<option value=\"$category_id\">Btech - $name</option>";
							}
 ?>
 </select>
          </p>
		  <p id="page_text">&nbsp;&nbsp;&nbsp;&nbsp;Title:&nbsp;&nbsp;
		  &nbsp;&nbsp;<input id="message_input" type="text" name="title" maxlength="75"></p>
          <p id="page_text">
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<textarea id="page_des" name="topic" cols="40" rows="8" maxlength="355"></textarea>
          <input id="login_button" name="submit" type="submit" value="Submit" /></p>
  </form>


                        <div id="section_submit">
							<div id="page_sub_head"><h4>Submitted Topics</h4></div>
							
							 <div id="forumlist_head">
							 <div id="forum_category">Category</div>
							 <div id="forum_post">Last Post</div>
							 <div id="forum_count">Topics</div>
							 </div>
							 <?php
							 
							 
							 $query=mysql_query("SELECT * FROM categories");
							  while($categories_row=mysql_fetch_assoc($query))
  {
    $categories[] = array(
                      'category_id' => $categories_row['category_id'],
                      'category_name' => $categories_row['category_name'],
                      );
   }
   
   							 foreach($categories as $category)
							 {
							 $id=$category['category_id'];
							 
							$query=mysql_query("SELECT count(topic_id)FROM topics WHERE category_id='$id'");
								$topic_count=mysql_result($query,0);
								
								$sql_query=mysql_query("SELECT title,topic_id FROM topics WHERE category_id='$id' ORDER BY topic_id DESC");
								$last_post=@mysql_fetch_assoc($sql_query);
							 
							 ?>
							 <div id="forumlist">
							 <div id="forum_category"><a href="category.php?id=<?php echo $id;?>">Btech-<?php echo $category['category_name'];?></a></div>
							 <div id="forum_post"><?php 
							 if(empty($last_post)){
echo 'No topic has been posted yet.';
}
else
{echo '<a href="topic.php?topic_id='.$last_post['topic_id'].'">'.$last_post['title'].'</a>'; }?></div>
							 <div id="forum_count"><?php echo $topic_count; ?></div>
							 </div>
							
							<?php
							}
                        
						
						
						?>
						</div>
</section>
<?php

include 'template/footer.php';

?>