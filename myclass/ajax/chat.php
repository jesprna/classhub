<?php

require '../core/init.php';


if(isset($_POST['method']) === true && empty($_POST['method']) === false){

			$chat = new Chat();
			$method = trim($_POST['method']);


			if ($method === 'fetch'){
					$messages = $chat->fetchMessages($_SESSION['current_class']);

					if (empty($messages) ===true){
						echo "There are no  mesasges";

					}else{


							foreach ($messages as $message) {

								$time_sent = $message['message_time'];
								 $date = date_create($time_sent);
   $time_sent = date_format($date, 'D M j Y g:i a');
								?>
								<div class="message">
									<b><a href="#"><?php echo $message['member_name']; ?></a></b> <a style="font-size: 0.8em;"><?php echo $time_sent; ?></a>
									<p><?php echo nl2br($message['message']); ?> </p>


								</div>


								<?php
								# code...
							}

					}

			}else if ($method=== 'throw' && isset($_POST['message']) === true){
				$message = trim($_POST['message']);
				if (empty($message) === false){
					$chat->throwMessage($_SESSION['user'], $message, $_SESSION['current_class']);
				}





			}


}


?>