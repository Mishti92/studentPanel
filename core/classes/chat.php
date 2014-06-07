<?php
class chat extends core
{
  public function fetchMessages()
  {
    $this->query("
           SELECT   chat.message,
                    users.user_name,
                    users.user_id
           FROM
                    chat
           Join     users
           ON       chat.user_id=users.user_id
           ORDER BY chat.timestamp
           DESC

    ");

    return $this->rows();

  }

  public function throwMessage($user_id,$message)
  {
    $this->query("
        INSERT INTO chat VALUES('',".(int)$user_id.",'".$this->db->real_escape_string(htmlentities($message))."',UNIX_TIMESTAMP())
    ");
  }

}

function Smilify(&$subject)
{
    $smilies = array(
        ':|'  => 'mellow',
        ':-|' => 'mellow',
        ':-o' => 'ohmy',
        ':-O' => 'ohmy',
        ':o'  => 'ohmy',
        ':O'  => 'ohmy',
        ';)'  => 'wink',
        ';-)' => 'wink',
        ':p'  => 'tongue',
        ':-p' => 'tongue',
        ':P'  => 'tongue',
        ':-P' => 'tongue',
        ':D'  => 'biggrin',
        ':-D' => 'biggrin',
        '8)'  => 'cool',
        '8-)' => 'cool',
        ':)'  => 'smile',
        ':-)' => 'smile',
        ':('  => 'sad',
        ':-(' => 'sad',
        ':-/' => 'confuse',
        ':/' => 'confuse',
        ':-*' => 'kiss',
        ':*' => 'kiss'
    );

    $sizes = array(
        'confuse' => 18,
        'biggrin' => 18,
        'cool' => 18,
        'haha' => 18,
        'mellow' => 18,
        'ohmy' => 18,
        'sad' => 16,
        'smile' => 14,
        'tongue' => 17,
        'wink' => 18,
        'kiss' => 18
    );

    $replace = array();
    foreach ($smilies as $smiley => $imgName)
    {
        $size = $sizes[$imgName];
        array_push($replace, '<img src="images/imgs/'.$imgName.'.gif" alt="'.$smiley.'" width="'.$size.'" height="'.$size.'" />');
    }
    $subject = str_replace(array_keys($smilies), $replace, $subject);
}


?>