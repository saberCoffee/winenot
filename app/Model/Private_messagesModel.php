<?php 
namespace Model;

use \W\Model\Model;

class Private_messagesModel extends Model{

	public function contact($objet, $email, $message){
		$message = 'Adresse mail du client: '. $email . ' : ' .$message;

		$data = array(
				'receiver_id'	=> '2620528902ee37259c51a57d2367dd67',
				'author_id'		=> 0,
				'subject'   	=> $objet,
				'content' 		=> $message
		);

		return $this->insert($data);

	}
}