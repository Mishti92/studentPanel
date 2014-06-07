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
	
	</div>
<a href="sign_up.php">
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
<div id="box">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login To Your Account
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<?php
			

			if(isset($_POST['login_email'],$_POST['login_password']))
			{
			  $login_email=$_POST['login_email'];
			  $login_password=$_POST['login_password'];

			  $errors=array();

			  if(empty($login_email)||empty($login_password))
			  {
				$errors[]= 'Email and Password required';
			  }
			  else
			  {
				$login = login_check($login_email,$login_password);

				if($login===false)
				{
				 $errors[]= 'Unable to login';
				}
			  }

			  if(!empty($errors))
			  {
				foreach($errors as $error)
				{
				
				  echo $error.'<br />';
				}
			  }
			  else
			  {
			  //log user in
			   $_SESSION['user_id']=$login;
			   header('Location: index.php');
			   exit();
			  }
			}


			?>





		<form action="" method="post">
		<input id="login_input" type="email" name="login_email" placeholder="Email"/>
		<input id="login_input" type="password" name="login_password" placeholder="Password"/>
        <input id="login_button" type="submit" value="Log in" />
		 &nbsp;&nbsp;&nbsp;
		 &nbsp;&nbsp;&nbsp;<a href="forgotpass.php">[Forgot Password?]</a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 Dont Have Account?	 &nbsp;&nbsp;&nbsp;<a href="register.php">Click here</a> to sign up for free...
		</form>   		</div>


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
		