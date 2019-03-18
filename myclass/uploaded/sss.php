<?php


class Chat extends Core{



	public function fetchMessages(){
			$this->query(" 

				SELECT class_chat.message,
						class_member.member_name,
						class_member.member_id


				FROM class_chat
				JOIN class_member
				ON class_chat.member_id = class_member.member_id
				ORDER BY class_chat.timestamp
				DESC 




				");
			return $this->rows();

	}



	public function throwMessages($member_id, $message){




	}
}

?>