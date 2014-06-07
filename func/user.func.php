<?php

function logged_in()
{
  return isset($_SESSION['user_id']);
}

function login_check($email, $password)   //returns user_id
{
  $email=mysql_real_escape_string($email); //to escape sql injection
  $login_query = mysql_query("SELECT COUNT(user_id) as count, user_id FROM users WHERE email='$email' AND password='".md5($password)."'");
  return(mysql_result($login_query,0)==1) ? mysql_result($login_query,0,'user_id') :false;
}

function user_data()
{
  $args = func_get_args();
  $fields = '`'.implode('`,`',$args).'`';

  $query= mysql_query("SELECT $fields FROM users WHERE user_id=".$_SESSION['user_id']);
  $query_result=mysql_fetch_assoc($query);
  foreach($args as $field)
  {
    $args[$field] = $query_result[$field];
  }
  return $args;

}
function other_user_data($user_id)
{
	$user_id=(int)$user_id;
  
  $query= mysql_query("SELECT * FROM users WHERE user_id='$user_id'");
  $data=@mysql_fetch_assoc($query);
  
  return $data;

}

function user_register($email,$name,$user_name,$password,$course,$year,$roll_no,$gender)
{
  $email = mysql_real_escape_string($email);
  $name=mysql_real_escape_string($name);
  $user_name=mysql_real_escape_string($user_name);
  $roll_no=mysql_real_escape_string($roll_no);
  $gender=mysql_real_escape_string($gender);
  mysql_query("INSERT INTO users VALUES('','$user_name','$email','$name','".md5($password)."','$course','$year','$roll_no',NULL,'$gender')");
  return mysql_insert_id();
}

 function user_edit($name,$username,$course,$year,$roll_no)
 {
  $name=mysql_real_escape_string($name);
  $username=mysql_real_escape_string($username);
  $roll_no=mysql_real_escape_string($roll_no);
  mysql_query("UPDATE users
  SET name='$name', user_name='$username', course='$course', year='$year' , roll_no='$roll_no'
  WHERE user_id=".$_SESSION['user_id']);
 }



function user_exists($email)
{
  $email=mysql_real_escape_string($email);
  $query=mysql_query("SELECT COUNT(user_id) FROM users WHERE email='$email'");
  return (mysql_result($query,0)==1) ? true : false;
}
function username_exists($name)
{
  $name=mysql_real_escape_string($name);
  $query=mysql_query("SELECT COUNT(user_id) FROM users WHERE user_name='$name'");
  return (mysql_result($query,0)==1) ? true : false;
}
function edit_username_exists($name)
{
  $name=mysql_real_escape_string($name);
  $user_id=$_SESSION['user_id'];
  $query=mysql_query("SELECT COUNT(user_id) FROM users WHERE user_name='$name' AND NOT user_id='$user_id'");
  return (mysql_result($query,0)==1) ? true : false;
}

function edit_password($password)
{
  $password =md5($password);
  mysql_query("UPDATE users
  SET password='$password'
  WHERE user_id=".$_SESSION['user_id']);
}

?>