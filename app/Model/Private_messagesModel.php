<?php
namespace Model;

use \W\Model\Model;

class Private_messagesModel extends Model{

	public function contact($objet, $email, $message){
		$message = 'Adresse mail du client: '. $email . ' : ' .$message;

		/*
			DevNote :
			A terme, il faudrait :
			1 - Chercher tous les users dont le role est 1 (admin)
			2 - Boucler desssus, et pour chacun d'entre eux, envoyer le PM en remplaçant 'receiver_id' par leur id respectifs
		*/
		$data = array(
				'receiver_id'	=> '2620528902ee37259c51a57d2367dd67',
				'author_id'		=> 0,
				'subject'   	=> $objet,
				'content' 		=> $message
		);

		return $this->insert($data);

	}
}
