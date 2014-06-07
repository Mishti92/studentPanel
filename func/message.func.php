<?php

function message_check($id){

  $id=(int)$id;
  $query=mysql_query("SELECT COUNT(id) FROM messages WHERE id='$id' AND receiver=".$_SESSION['user_id']);
  return (mysql_result($query , 0) == 0) ? 0 : 1;


}

function message_sent_check($id){

  $id=(int)$id;
  $query=mysql_query("SELECT COUNT(id) FROM messages WHERE id='$id' AND sender=".$_SESSION['user_id']);
  return (mysql_result($query , 0) == 0) ? 0 : 1;


}

 function delete_message($id)
 {

  $id=(int)$id;
  mysql_query("UPDATE messages SET status='trash' WHERE id='$id'");
 }

 function delete_sent_message($id)
 {

  $id=(int)$id;
  mysql_query("UPDATE messages SET sender_status='trash' WHERE id='$id'");
 }

 function delete_message_forever($id)
 {

  $id=(int)$id;
  mysql_query("UPDATE messages SET status='nothing' WHERE id='$id' AND status='trash'");
 }

function get_messages($user_id)
{
	$user_id=(int)$user_id;
  $messages = array();

  $messages_query= mysql_query("
  SELECT * 
  FROM  `messages`
  WHERE receiver='$user_id' AND NOT status='trash' AND NOT status='nothing'
  ORDER BY  `messages`.`id` DESC");

  while($messages_row=mysql_fetch_assoc($messages_query))
  {
    $messages[] = array(
                      'id' => $messages_row['id'],
                      'receiver' => $messages_row['receiver'],
                      'sender' => $messages_row['sender'],
                      'subject' => $messages_row['subject'],
                      'body' => $messages_row['body'],
                      'date_sent' => $messages_row['date_sent'],
                      'status' => $messages_row['status'],
                      );
   }


  return $messages;

}


function get_sent_messages($user_id)
{
	$user_id=(int)$user_id;
  $messages = array();

  $messages_query= mysql_query("
  SELECT * 
  FROM  `messages`
  WHERE sender='$user_id' AND sender_status='sent'  
  ORDER BY  `messages`.`id` DESC");

  while($messages_row=mysql_fetch_assoc($messages_query))
  {
    $messages[] = array(
                      'id' => $messages_row['id'],
                      'receiver' => $messages_row['receiver'],
                      'sender' => $messages_row['sender'],
                      'subject' => $messages_row['subject'],
                      'body' => $messages_row['body'],
                      'date_sent' => $messages_row['date_sent'],
                      'status' => $messages_row['status'],
                      );
   }


  return $messages;

}
function get_trash_messages($user_id)
{
	$user_id=(int)$user_id;
  $messages = array();

  $messages_query= mysql_query("
  SELECT * 
  FROM  `messages`
  WHERE receiver='$user_id' AND status='trash'
  ORDER BY  `messages`.`id` DESC");

  while($messages_row=mysql_fetch_assoc($messages_query))
  {
    $messages[] = array(
                      'id' => $messages_row['id'],
                      'receiver' => $messages_row['receiver'],
                      'sender' => $messages_row['sender'],
                      'subject' => $messages_row['subject'],
                      'body' => $messages_row['body'],
                      'date_sent' => $messages_row['date_sent'],
                      'status' => $messages_row['status'],
                      );
   }


  return $messages;

}

function self_message($receiver){
	$receiver=mysql_real_escape_string($receiver);
	$query=mysql_query("SELECT user_name FROM users WHERE user_id=".$_SESSION['user_id']);
	$user_name=mysql_result($query,0);
	if($user_name==$receiver){
	 return false;
	}
		else{
		return true;
		}
}

function send_message($receiver,$subject,$body){
	$receiver=mysql_real_escape_string($receiver);
	$subject=mysql_real_escape_string($subject);
	$body=mysql_real_escape_string($body);
	$sql=mysql_query("SELECT user_id FROM users WHERE user_name='$receiver'");
	$receiver_id=mysql_result($sql,0);
	$sender=$_SESSION['user_id'];
	mysql_query("INSERT INTO messages VALUES('','$receiver_id','$sender','$subject','$body',UNIX_TIMESTAMP(),'unread','sent')");
}

function message_data($id){

$id=(int)$id;
$messages = array();

  $messages_query= mysql_query("
  SELECT * 
  FROM  messages
  WHERE id='$id'
  ");
  
  $messages=mysql_fetch_assoc($messages_query);

  return $messages;
}


?>
