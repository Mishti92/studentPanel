<?php

function album_data($album_id)
{
  $album_id=(int)$album_id;
  $args = func_get_args();
  unset($args[0]);  //unsets args as we dont want to include $album_id in args
  $fields = '`'.implode('`,`',$args).'`';

  $query= mysql_query("SELECT $fields FROM albums WHERE album_id='$album_id' AND user_id=".$_SESSION['user_id']);
  $query_result=mysql_fetch_assoc($query);
  foreach($args as $field)
  {
    $args[$field] = $query_result[$field];
  }
  return $args;

}
function album_check($album_id)   //to make sure users cant view each others albums
{
  $album_id=(int)$album_id;
  $query = mysql_query("SELECT COUNT(`album_id`) FROM `albums` WHERE `album_id`='$album_id' AND `user_id`=".$_SESSION['user_id']);
  return (mysql_result($query,0)==1)? true : false;
}

function get_albums()
{
  $albums=array();

  $albums_query=mysql_query("
  SELECT albums.album_id, albums.timestamp, albums.name, LEFT(albums.description,50) as description, COUNT(images.image_id) as image_count
  FROM albums
  LEFT JOIN images
  ON albums.album_id = images.album_id
  WHERE albums.user_id = ".$_SESSION['user_id']."
  GROUP BY albums.album_id
  ");

  while($albums_row=mysql_fetch_assoc($albums_query))
  {
    $albums []= array(
                'id' => $albums_row['album_id'],
                'timestamp' => $albums_row['timestamp'],
                'name' => $albums_row['name'],
                'description' => $albums_row['description'],
                'count' => $albums_row['image_count'],
    );
  }

  return $albums;


}

function create_album($album_name,$album_description,$album_course,$album_year)
{
  echo $album_name = mysql_real_escape_string(htmlentities($album_name));
  echo $album_description= mysql_real_escape_string(htmlentities($album_description));

  mysql_query("INSERT INTO albums VALUES('','".$_SESSION['user_id']."', UNIX_TIMESTAMP() , '$album_name' , '$album_description','$album_course','$album_year') ");
  mkdir('uploads/'.mysql_insert_id(),0755);    //7 means access to our server and 44 just read only permission
  mkdir('uploads/thumbs/'.mysql_insert_id(),0755);
}

function edit_album($album_id,$album_name,$album_description,$album_course,$album_year)
{
  $album_id=(int)$album_id;
  $album_name=mysql_real_escape_string($album_name);
  $album_description=mysql_real_escape_string($album_description);

  mysql_query("
  UPDATE albums
  SET name='$album_name', description='$album_description', course ='$album_course', year='$album_year'
  WHERE album_id='$album_id' AND user_id=".$_SESSION['user_id']."
  ");
}

function delete_album($album_id)
{
  $album_id=(int)$album_id;

  $loc="./uploads/$album_id/*";
  array_map("unlink",glob($loc));
  rmdir("./uploads/".$album_id);

  $loc="./uploads/thumbs/$album_id/*";
  array_map("unlink",glob($loc));
  rmdir("./uploads/thumbs/".$album_id);

  mysql_query("DELETE FROM albums WHERE album_id='$album_id' AND user_id=".$_SESSION['user_id']);
  mysql_query("DELETE FROM images WHERE album_id='$album_id' AND user_id=".$_SESSION['user_id']);

}

?>