<?php

function notes_check($course,$year)   //will check if the course and year are valid
{
  $year=(int)$year;
  $course= mysql_real_escape_string($course);
  $course=strtolower($course);

  $allowed_course= array('cse','eee','ce','mae','ece','it','ae','ei','et');

  $error =0;

  if($year == 1 || $year == 2 || $year == 3 || $year == 4)
  {
   if(in_array($course,$allowed_course) === false)
    {
       $error = 1;
    }
    else
    {
      $error =0;
    }
  }
  else
  {
   $error = 1;
  }

  if($error == 0)
  {
   return true;
  }

  else
  {
     return false;
  }
}



 function get_notes_docs($course,$year)
 {

  $year=(int)$year;
  $course= mysql_real_escape_string($course);
  $course=strtolower($course);


  $docs = array();

  $docs_query= mysql_query("
  SELECT user_id, doc_id, timestamp, name, ext
  FROM documents
  WHERE course='$course' AND year ='$year'
  ORDER BY doc_id DESC");

  while($docs_row=mysql_fetch_assoc($docs_query))
  {
    $docs[] = array(
                      'user_id' => $docs_row['user_id'],
                      'doc_id' => $docs_row['doc_id'],
                      'timestamp' => $docs_row['timestamp'],
                      'ext' => $docs_row['ext'],
                      'name'=>$docs_row['name'],
                      );
   }

  return $docs;

 }


 function get_notes_albums($course,$year)
 {


  $albums=array();

  $year=(int)$year;
  $course= mysql_real_escape_string($course);
  $course=strtolower($course);


  $albums_query=mysql_query("
  SELECT albums.user_id, albums.album_id, albums.timestamp, albums.name, LEFT(albums.description,50) as description, COUNT(images.image_id) as image_count
  FROM albums
  LEFT JOIN images
  ON albums.album_id = images.album_id
  WHERE albums.course='$course' AND albums.year='$year'
  GROUP BY albums.album_id DESC
  ");

  while($albums_row=mysql_fetch_assoc($albums_query))
  {
    $albums []= array(
                'user_id' => $albums_row['user_id'],
                'album_id' => $albums_row['album_id'],
                'timestamp' => $albums_row['timestamp'],
                'name' => $albums_row['name'],
                'description' => $albums_row['description'],
                'count' => $albums_row['image_count'],
    );



  }
  
  return $albums;
 }


?>