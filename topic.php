<?php
include 'init.php';


if(!logged_in())
{
  header('Location: index.php');
  exit;
}


include 'template/header.php';


if(!isset($_GET['topic_id']) || empty($_GET['topic_id']))
{
header('Location: submit_topic.php');
exit();
}

$topic_id=$_GET['topic_id'];


$query=mysql_query("SELECT COUNT(topic_id) FROM topics WHERE topic_id=$topic_id");
$no=mysql_result($query , 0);

if($no == 0)
{
header('Location: submit_topic.php');
exit();
}
?>
<section id="section">
<?php

$topic=get_topic_data($topic_id);
$user=$_SESSION[user_id];

                      $topic_content=$topic['topic_content'];
                      $category_id=$topic['category_id'];
                      $user_id=$topic['user_id'];
                      $title=$topic['title'];
                      $name=$topic['user_name'];

                      $topic_timestamp=$topic['timestamp'];
                      $query ="
                SELECT categories.category_name
                FROM topics JOIN categories
                ON topics.category_id=categories.category_id
                WHERE topics.topic_id='$topic_id'";
                $category_query=mysql_query($query);
                $category_name =mysql_result($category_query,0);

                $timezone = "Asia/Calcutta";

if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
                $date = date('d-m-Y H:i',$topic_timestamp);


                echo '<p id="page_head"><strong>Topic:</p>';
?>
<div id="section_submit">

							 <div id="forumlist">
							 <div id="forum_post">Title:&nbsp;<?php echo $title; ?></div>
							 <?php
							 if($user== $user_id)
							 {							 
							 ?>
							 <div id="forum_count"><a href="delete_topic.php?topic_id=<?php echo $topic_id?>">Delete</a></div>
<?php
}
?>
							 </div>
<?php

				
				echo '<div id="forumlist"><div id="forum_post"> Description: '.$topic_content.'</div></div>';
                
                echo "<div id='forumlist'>
				<div id='forum_post'>Category : <a href='category.php?id=$category_id'>Btech- $category_name</a></div>
				<div id='forum_category'>By <a href='view_someone.php?id=$user_id'>$name</a></div>
				<div id='forum_category'>$date</div></div></div>
				<div id='section_submit'>";

				echo '<div id="page_sub_head"><h4>Replies</h4></div>';
				
			$replies = get_replies($topic_id);
			if(empty($replies))
			{
                          echo '<div id="forumlist"><div id="forum_post">No one has replied yet. </div></div>';
						 }
                        else
                        {
								?>						
							 <div id="forumlist_head">
							 <div id="forum_post">Reply</div>
							 <div id="forum_category">Author</div>
							 <div id="forum_category">Date</div>
							 </div>
<?php
							
                          foreach($replies as $reply)
                          {
                            $user_id=$reply['reply_user_id'];
                            $name= $reply['reply_user_name'];
                            $reply_id=$reply['reply_id'];
                            if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

                            $date = @date('d-m-Y H:i',$reply['timestamp']);
                            $reply_content = $reply['reply_content'];
							
							?>
							
							<div id="forumlist">
							 <div id="forum_post"><?php echo $reply_content; ?>
							 <?php
							 if($user == $user_id)
							 {
							 ?>
							 <a href="delete_reply.php?reply_id=<?php echo $reply_id; ?>">[Delete]</a>
							 <?php
							 }
							 ?>
							 </div>
							 <div id="forum_category"><a href="view_someone.php?id=<?php echo $user_id; ?>"><?php echo $name; ?></a></div>
							 <div id="forum_category"><?php echo $date; ?></div>
							 
							 </div>
							 <?php
							 }
							 
							 }
							 ?>
							</div>
							
<div id="section_submit">


<?php


if(isset($_POST['reply']))
{          $reply = $_POST['reply'];
          $topic_id = $_POST['topic_id'];
          $user_id= $_SESSION['user_id'];
          $name=$_POST['name'];
echo '<div id="error_bar">';
          if(empty($reply))
              {
                 echo 'Please enter a reply.';
              }
          else if(empty($name))
              {
                echo 'Name required';
              }
          else
              {
              $sql = "INSERT INTO replies VALUES ('', '$reply', '$topic_id', '$user_id',UNIX_TIMESTAMP(),'$name');";
              $rsd = mysql_query($sql);
              if($rsd)
              {
              header('Location: topic.php?topic_id='.$topic_id.'');
              exit();
              }
              else
              {
              echo "Error, reply submission fail";
              }

              }
echo '</div>';
			  }

?>

          		<form action="" method="post" name="reply_form">
          		<textarea id="page_des_sub" name="reply" cols="120" rows="3"></textarea>
          		<input type="hidden" name="topic_id" value="<?php echo"$topic_id" ?>" />
          		
				<p id="page_text">Name : <input id="message_input" type="text"
				name="name" value="<?php $user_data = user_data('user_name'); echo $user_data['user_name']; ?>" />
				<input id="login_button" name="submit" type="submit" value="Reply" />
				</p>
				</form>

</div>

</section>
   
<?php
include 'template/footer.php';
?>
