<?php


class Chat extends Core {



	public function fetchMessages($class_id){
		
			$this->query("
				select class_chat.message,
						class_chat.message_time,
						class_member.member_name,
						class_member.member_id
				FROM class_chat
				JOIN class_member
				ON class_chat.member_id = class_member.member_id
				where class_chat.class_id = '{$class_id}'
				ORDER BY class_chat.timestamp
				desc
				");


			return $this->rows();

	}



	public function throwMessage($member_id, $message, $class_id){
		$this->db = new mysqli('localhost','id1834528_ejaycode','09159931846','id1834528_ejaycode');
		$this->query("
		insert into class_chat (member_id, message,timestamp, class_id, message_time)
		values (" . (int)$member_id . ", '" . $this->db->real_escape_string(htmlentities($message)) . "', UNIX_TIMESTAMP(), " . (int)$class_id . ", NOW())

			");




	}
}



?>