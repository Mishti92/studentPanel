<?php


function doc_data($doc_id)
{
  $doc_id=(int)$doc_id;
  $args = func_get_args();
  unset($args[0]);  //unsets args as we dont want to include $album_id in args
  $fields = '`'.implode('`,`',$args).'`';

  $query= mysql_query("SELECT $fields FROM documents WHERE doc_id='$doc_id' AND user_id=".$_SESSION['user_id']);
  $query_result=mysql_fetch_assoc($query);
  foreach($args as $field)
  {
    $args[$field] = $query_result[$field];
  }
  return $args;

}


function upload_doc($file_temp,$file_ext,$doc_name,$doc_course,$doc_year)
{
  $file_name=mysql_real_escape_string($doc_name);
  mysql_query("INSERT INTO documents VALUES('','".$_SESSION['user_id']."','$file_name',UNIX_TIMESTAMP(),'$file_ext','$doc_course','$doc_year')");
  echo $file_id = mysql_insert_id();
  $location = 'docs/';
  $doc_file = $file_id.'.'.$file_ext;
  move_uploaded_file($file_temp,$location.$doc_file);
 }
 
 
 

function edit_doc($doc_id,$doc_name,$doc_course,$doc_year)
{

  $doc_id=(int)$doc_id;
  $doc_name=mysql_real_escape_string($doc_name);

  mysql_query("
  UPDATE documents
  SET name='$doc_name', course ='$doc_course', year='$doc_year'
  WHERE doc_id='$doc_id' AND user_id=".$_SESSION['user_id']."
  ");

}


 function doc_check($doc_id)
 {
   $doc_id=(int)$doc_id;
  $query=mysql_query("SELECT COUNT(doc_id) FROM documents WHERE doc_id='$doc_id' AND user_id=".$_SESSION['user_id']);
  return (mysql_result($query , 0) == 0) ? false : true;

 }


 function get_docs()
 {

  $docs = array();

  $docs_query= mysql_query("
  SELECT doc_id, timestamp, name, ext, course, year
  FROM documents
  WHERE user_id =".$_SESSION['user_id']);

  while($docs_row=mysql_fetch_assoc($docs_query))
  {
    $docs[] = array(
                      'id' => $docs_row['doc_id'],
                      'timestamp' => $docs_row['timestamp'],
                      'ext' => $docs_row['ext'],
                      'name'=>$docs_row['name'],
                      'course' =>$docs_row['course'],
                      'year' =>$docs_row['year']
                      );
   }

  return $docs;



 }


 function delete_doc($doc_id)
 {

  $doc_id=(int)$doc_id;

  $doc_query=mysql_query("SELECT ext FROM documents WHERE doc_id='$doc_id' AND user_id=".$_SESSION['user_id']);
  $doc_result= mysql_fetch_assoc($doc_query);

  $doc_ext=$doc_result['ext'];

  unlink('docs/'.$doc_id.'.'.$doc_ext);

  mysql_query("DELETE FROM documents WHERE doc_id='$doc_id' AND user_id=".$_SESSION['user_id']);


 }

?>