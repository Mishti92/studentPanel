<?php

function time2str($ts)
{
    if(!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if($diff == 0)
        return 'now';
    elseif($diff > 0)
    {
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 60) return 'just now';
            if($diff < 120) return '1 minute ago';
            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
            if($diff < 7200) return '1 hour ago';
            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
        }
        if($day_diff == 1) return 'Yesterday';
        if($day_diff < 7) return $day_diff . ' days ago';
        if($day_diff < 31) return ceil($day_diff / 7) . ' week ago';
        if($day_diff < 60) return 'last month';
        return date('F Y', $ts);
    }
    else
    {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if($day_diff == 0)
        {
            if($diff < 120) return 'in a minute';
            if($diff < 3600) return 'in ' . floor($diff / 60) . ' minutes';
            if($diff < 7200) return 'in an hour';
            if($diff < 86400) return 'in ' . floor($diff / 3600) . ' hours';
        }
        if($day_diff == 1) return 'Tomorrow';
        if($day_diff < 4) return date('l', $ts);
        if($day_diff < 7 + (7 - date('w'))) return 'next week';
        if(ceil($day_diff / 7) < 4) return 'in ' . ceil($day_diff / 7) . ' weeks';
        if(date('n', $ts) == date('n') + 1) return 'next month';
        return date('F Y', $ts);
    }
	
	}



function get_topics()
{
  $topics = array();

  $topics_query= mysql_query("
  SELECT topic_id, title,topic_content, category_id, user_id, timestamp ,user_name
  FROM  `topics`
  ORDER BY  `topics`.`topic_id` DESC");

  while($topic_row=mysql_fetch_assoc($topics_query))
  {
    $topics[] = array(
                      'topic_id' => $topic_row['topic_id'],
                      'title' => $topic_row['title'],
                      'topic_content' => $topic_row['topic_content'],
                      'category_id' => $topic_row['category_id'],
                      'user_id' => $topic_row['user_id'],
                      'timestamp' => $topic_row['timestamp'],
                      'user_name' => $topic_row['user_name'],
                      );
   }


  return $topics;

}
function get_topic_by_category($id){
$id=(int)$id;

  $topics = array();

  $topics_query= mysql_query("
  SELECT topic_id, topic_content, user_id, title,timestamp ,user_name
  FROM  `topics` WHERE category_id='$id'
  ORDER BY  `topics`.`topic_id` DESC");

  while($topic_row=mysql_fetch_assoc($topics_query))
  {
    $topics[] = array(
                      'topic_id' => $topic_row['topic_id'],
                      'title' => $topic_row['title'],
                      'topic_content' => $topic_row['topic_content'],
                      'user_id' => $topic_row['user_id'],
                      'timestamp' => $topic_row['timestamp'],
                      'user_name' => $topic_row['user_name'],
                      );
   }


  return $topics;

}

function get_topic_data($topic_id)
{
  $topics = array();

  $topics_query= mysql_query("
  SELECT topic_content,title, category_id, user_id, timestamp ,user_name
  FROM  `topics`
  WHERE topic_id='$topic_id'
  ");
  
  $topics=mysql_fetch_assoc($topics_query);

  return $topics;

}


function get_replies($topic_id)
{
  $topic_id=(int)$topic_id;
  $replies = array();

  $replies_query= mysql_query("SELECT reply_id,reply_content,reply_user_id, timestamp , reply_user_name FROM  `replies` where `replies`.`topic_id` = '$topic_id'");

  while($replies_row=mysql_fetch_assoc($replies_query))
  {
    $replies[] = array(
                      'reply_id' => $replies_row['reply_id'],
                      'reply_content' => $replies_row['reply_content'],
                      'reply_user_id' => $replies_row['reply_user_id'],
                      'timestamp' => $replies_row['timestamp'],
                      'reply_user_name' => $replies_row['reply_user_name'],
                      );
   }

  return $replies;

}

 function delete_topic($topic_id)
 {

  $topic_id=(int)$topic_id;
  mysql_query("DELETE FROM replies WHERE topic_id='$topic_id'");
  mysql_query("DELETE FROM topics WHERE topic_id='$topic_id' AND user_id=".$_SESSION['user_id']);


 }


  function delete_reply($reply_id)
 {

  $reply_id=(int)$reply_id;

  mysql_query("DELETE FROM replies WHERE reply_id='$reply_id' AND reply_user_id=".$_SESSION['user_id']);


 }

 function topic_check($topic_id)
 {
  $topic_id=(int)$topic_id;
  $query=mysql_query("SELECT COUNT(topic_id) FROM topics WHERE topic_id='$topic_id' AND user_id=".$_SESSION['user_id']);
  return (mysql_result($query , 0) == 0) ? 0 : 1;

 }



 function reply_check($reply_id)
 {
  $reply_id=(int)$reply_id;
  $query=mysql_query("SELECT COUNT(reply_id) FROM replies WHERE reply_id='$reply_id' AND reply_user_id=".$_SESSION['user_id']);
  return (mysql_result($query , 0) == 0) ? 0 : 1;

 }




?>