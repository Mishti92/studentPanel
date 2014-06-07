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
     
	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="js/tms-0.3.js" type="text/javascript"></script>
	<script src="js/tms_presets.js" type="text/javascript"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
	    <link rel='stylesheet' type='text/css' href='css/index.css' >
     
	
</head>
<body bgcolor="#000">
<center><table cellpadding="0" cellspacing="0" height="100%" border="0" bgcolor="#ccc">
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
	<section>
			<div class="row-bot">
			<div class="slider-wrapper">
				<div class="slider">
					<ul class="items">
						<li>
							<img src="images/1.jpg" alt="" />
						</li>
						<li>
							<img src="images/2.jpg" alt="" />
						</li>
						<li>
							<img src="images/3.jpg" alt="" />
						</li><li>
							<img src="images/4.jpg" alt="" />
						</li>
					</ul>
				</div>
			</div>
		</div>

	</section>

	<section id="login">
<div id="box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Forgot password</strong>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<?php
	if(isset($_POST['email'],$_POST['roll_no']))
	{
	$email=$_POST['email'];
	$roll_no=$_POST['roll_no'];
		if(empty($email)||empty($roll_no))
		{
			echo 'Please fill in all the details..';
		}
		else
		{
			$query=@mysql_query("SELECT user_id FROM users WHERE email='$email' AND roll_no='$roll_no'");
			$result=@mysql_result($query,0);
			if(empty($result))
			{
			echo 'Wrong email, roll number combination, Please enter again !!';
			}
			else{
				function unique_id($l = 8) {
                 return substr(md5(uniqid(mt_rand(), true)), 0, $l);
				}
				$new_pass=unique_id();
				$to= $email;
				   $subject = 'Forgot password';
				   $body = "Your new password is $new_pass\n Please login to change your password.\n Thanks
\n Amity Student Panel";
				   $headers='From: amitystudentpanel@gmail.com';
				 if(@mail($to,$subject,$body,$headers))
			   {	mysql_query("UPDATE users SET password='".md5($new_pass)."' WHERE user_id='$result'");
			   echo 'Your new password has been generated and sent to the email 
associated with your account.';
			   }
			   else
			   {
				echo 'Sorry, an error occured.Please try again later. ';
			   }
			}
			
		}
	}

?>





		<p>	<form action="" method="post"><p>&nbsp;&nbsp;&nbsp;A reset link will be sent to the email address associated with your account...
		&nbsp;&nbsp; <input id="login_input" type="email" name="email" 
		placeholder="Email"/> &nbsp;&nbsp;&nbsp;  <input id="login_input" name="roll_no" 
		placeholder="Enrollment No."/>&nbsp;&nbsp;<input id="login_button" type="submit" value="Send" /></p>
		</div>


</section>
				
			

	
	</section>
		</td>

</table></center>

	<script type="text/javascript">
		$(window).load(function() {
			$('.slider')._TMS({
				duration:1000,
				easing:'easeOutQuint',
				preset:'diagonalFade',
				slideshow:7000,
				banners:false,
				pauseOnHover:true,
				pagination:true,
				pagNums:false
			});
		});
	</script>
</body>
</html>
			