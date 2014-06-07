<?php
include 'init.php';

if(logged_in())
{
   header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>            

<html lang="en"> 
<head>
   <meta charset="utf-8" /> 
   <title>ASP</title>
       <link rel='stylesheet' type='text/css' href='css/index.css' >
     
	
</head>
<body bgcolor="#000">
<center><table cellpadding="0" cellspacing="0" height="100%" border="0" >
	<tr>
		<td height="671" style="border: 15px groove #333333; margin:0px auto; background:url(images/grey.png) 0 0 ;">
	<section id="bigWrapper">
	<header id="sign_header">

	<div id="logo">
	
			<img src="images/logo/1.png" width=40 height=35 />
					Amity <span id="logo_head">StudentPanel</span>
	
	</div><a href="sign_up.php">
	<div id="side_logo">
	Home
	</div>
	</a>
	<a href="register.php">
	<div id="side_logo">
	Register
	</div></a>

	</header>
	
<div id="register_wrap">
				<div id="get_reg">Register here</div>
						<div id="getReg">Fill in the required information below to start uploading and downloading class documents, as well as to connect with other students in your classes/branch.
						</div>
							
						<div id="error_bar">
						
						
						<?php

						if(!isset($_POST['secure']))
						{
						$_SESSION['secure']= rand(1000,9999);
						}
						else
						{
						if (isset($_POST['register_email'],$_POST['register_name'],$_POST['roll_no'],
						$_POST['gender'],$_POST['register_password'],$_POST['register_username'],$_POST['confirm_password'],$_POST['register_course'],
						$_POST['register_year']))
						{
						$register_email=$_POST['register_email'];
						$register_username=$_POST['register_username'];
						$register_name=$_POST['register_name'];
						$register_password=$_POST['register_password'];
						$confirm_password=$_POST['confirm_password'];
						$register_course=$_POST['register_course'];
						$register_year=$_POST['register_year'];
						$gender=$_POST['gender'];
						$roll_no=$_POST['roll_no'];


						$errors = array();

						if(empty($register_email)||empty($register_name)||empty($register_username)||empty($roll_no)||empty($gender)||
						empty($register_password)||empty($confirm_password)||empty($register_course)||empty($register_year))
						{
						  $errors[] ='All fields required';
						}
						else
						{
						  if(filter_var($register_email,FILTER_VALIDATE_EMAIL)=== false)
						  {
							$errors[]= 'Email address not valid';
						  }
						  if(strlen($register_email)>255||strlen($register_name)>35||strlen($register_password)>35)
						  {
							$errors[]='One or more fields contain too many characters';
						  }
						  if(user_exists($register_email) === true )
						  {
						   $errors[]='Email has been already registered. ';
						  }
						  if(username_exists($register_username) === true )
						  {
						   $errors[]='Username not available';
						  }
						  if($confirm_password != $register_password)
						  {
							$errors[]='Passwords do not match';
						  }
						}

						if(!empty($errors))
						{
						  foreach($errors as $error)
						  {
						  
						  ?>
						  
				<span id="error">*</span>
						  <?php
							echo $error.'&nbsp;&nbsp;';
						  }
						}
						else
						{
						  if($_SESSION['secure'] == $_POST['secure'])
						  {

							  $register =user_register($register_email,$register_name,$register_username,$register_password,$register_course,$register_year,$roll_no,$gender);
							  $_SESSION['user_id']= $register;
							  header('Location: index.php');
							  exit();

						 }

						  else
						  {
							 echo '<span id="error">*</span>Incorrect. try again';
							 $_SESSION['secure']= rand(1000,9999);
						  }
						}
						}


						}

						?>
						
					</div>			
						
					<div id="Reg_div">
					<div id="regis1" style="background-image: url(images/greyy.jpg);">
						<form action ="" method ="POST">
						<div id="forumlist_head">
						<div id="forum_category">
						Full name
						</div>
						<div id="forum_post"> <input id="register_input" type ="text" name="register_name" maxlength="35"/>
						</div>
						</div>
						
						<div id="forumlist_head">

						<div id="forum_category">
						Email
						</div>
						<div id="forum_post">
						<input id="register_input" type ="email" name="register_email" size="35" maxlength="255"/>
						</div>
						</div>


						<div id="forumlist_head">
						<div id="forum_category">
						Password
						</div>
						<div id="forum_post">
						<input id="register_input"  type=password name="register_password" size="35" maxlength="255"/>
						
						</div>
						</div>						
						
						
						
						<div id="forumlist_head">
						<div id="forum_category">
						Gender
						</div>
						<div id="forum_post">&nbsp;&nbsp;&nbsp;
						 Male<input id="register_radio" type="radio" name="gender" value="male"/>&nbsp;&nbsp;&nbsp;&nbsp;
						   Female<input id="register_radio" type="radio" name="gender" value="female"/> </p>
						    
						</div>
						</div>				
						
						
						<div id="forumlist_head">
						<div id="forum_category">
						Course
						</div>
						<div id="forum_post"><select id="register_input" name ="register_course">
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
						<div id="forum_category">
						Year</div>
						<div id="forum_post">
						<select id="register_input" name ="register_year">
											<option value="1">1st</option>
											<option value="2">2nd</option>
											<option value="3">3rd</option>
											<option value="4">4th</option>
								 </select>
						
						</div>
						</div>				
</div>						
						<div id="regis1" style="background-image: url(images/greyy.jpg);">	

<div id="forumlist_head">
						<div id="forum_post">
						Enter Username &nbsp;
						</div>
						<div id="forum_post"><input id="register_input" type ="text" name="register_username" size="35" maxlength="35"/>
						
						</div>
						</div>						
						
								
<div id="forumlist_head">
						<div id="forum_post">
						Enrollment no.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<div id="forum_post">
						<input  id="register_input"  name="roll_no" maxlength="35"/>
						</div>
						</div>				
<div id="forumlist_head">
						<div id="forum_post">
						Confirm password
						</div>
						<div id="forum_post">
						<input  id="register_input" type ="password" name="confirm_password" maxlength="35"/>
						</div>
						</div>						
						
						
								
						
								
<div id="forumlist_head">
						<div id="forum_category">
						</div>
						<div id="forum_post">
		 <img id="secure" src="generate.php" />		
						</div>
						</div>				
						
						
							
<div id="forumlist_head">
						<div id="forum_post">
						Enter the value&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<div id="forum_post">
								<input  id="register_input" type="text" size=10 name="secure" />
						</div>
						</div>				
						
						
						
								 </div>
						
						</div><div id="regSub">
						<p id="reg_par"><input id="login_button" type="submit" value ="Register"/></p>
</div>						</form>
			
	</section>
		</td>
	
</table></center>
</body>
</html>
