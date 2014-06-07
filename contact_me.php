<?php
include 'init.php';
if(!logged_in())
{
  header('Location: index.php');
  exit();
}

$user_data = user_data('email','name');
$email= $user_data['email'];

include 'template/header.php';
?>

<section id="section">
<div id="page_head"><h3>Contact Us</h3></div>
<div id="section_submit">
<?php

 if(isset($_POST['contact_name'],$_POST['contact_email'],$_POST['contact_text']))
 {
    $contact_name= $_POST['contact_name'];
    $contact_email = $_POST['contact_email'];
    $contact_text= $_POST['contact_text'];
   if(empty($contact_name)||empty($contact_email)||empty($contact_text))
   {
	 echo '<div id="error_bar">';
  	
     echo 'Please fill in all the fields';
   echo '</div>';
   }
   else
   {
     if (strlen($contact_name>25)|| strlen($contact_email)>50 ||strlen ($contact_text)>1000)
     {
	  echo '<div id="error_bar">';
  
       echo 'Sorry, max length for some field has been exceeded. ';
echo '</div>';    
	}
     else
     {
   $to= 'amitystudentpanel@gmail.com';
   $subject = 'Contact form Submitted';
   $body = $contact_name."\n".$contact_text;
   $headers='From: '.$contact_email;
    echo '<div id="error_bar">';
  
   if(@mail($to,$subject,$body,$headers))
   {
   echo 'Thanks for contacting us. We\'ll be in touch soon. ';
   }
   else
   {
    echo 'Sorry, an error occured.Please try again later. ';
   }
   echo '</div>';
     }
   }
 }


?>


<form action ="" method ="POST">

<div id="forumlist_head">
<div id="forum_category">Name
</div>
<div id="forum_post">				  <input id="page_input" type ="text" name ="contact_name" maxlength =25 value="<?php echo $user_data['name']; ?>" />
</div>
</div>


<div id="forumlist_head">
<div id="forum_category">Email
</div>
<div id="forum_post"><input id="page_input" type="email" name ="contact_email" maxlength =50 value="  <?php echo $email; ?>" />
</div>
</div>


<div id="forumlist_head">
<div id="forum_category">Message
</div>
<div id="forum_post"><textarea id="page_des" name ="contact_text" rows="6" cols="30" maxlength=1000></textarea>
</div>
</div>


<div id="forumlist">

<div id="forum_post">
</div>
<div id="forum_category">

 <input id="login_button" type="submit" value="Send">
</div>
</div>
 </form>
 </div>
</section>
<?php

include 'template/footer.php';

?>