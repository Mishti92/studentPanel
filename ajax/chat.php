<?php
require '../core/init.php';

if(isset($_POST['method']) === true && empty ($_POST['method']) === false)
{
  $chat = new chat();
  $method = trim($_POST['method']);

  if($method === 'fetch')
  {
    $messages = $chat->fetchMessages();

    if(empty($messages) === true)
    {
     echo 'There are currently no messages in the chat';
    }
    else
    {
      foreach($messages as $message)
      {     Smilify($message['message']); 
        ?>
             <div class="message">
			 
                       <?php
						$user_id=$_SESSION['user_id'];
						$chat_user_id=$message['user_id'];
						
						if($user_id==$chat_user_id){
						echo '<div id="link_user">'.$message['user_name'].'</div>'; 
						echo '<div id="talkbubble_user"></a>';
						echo nl2br($message['message']); ?>
						<?php
						echo '</div>';
						}
						
						else{
						echo '<div id="link_chat"><a href="view_someone.php?id='.$message['user_id'].'">'.$message['user_name'].'</a></div>'; 
						
						echo '<div id="talkbubble">';
						echo nl2br($message['message']); ?>
							<?php				echo '</div>';	

						}
						?>
			 
			 </div>

        <?php
      }
    }
  }
  else if ($method === 'throw' && isset($_POST['message']) === true)
  {
     $message = trim($_POST['message']);
     if(empty($message) === false)
     {
       $chat->throwMessage($_SESSION['user_id'],$message);
     }
  }
  }
?>