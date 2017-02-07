<?php
namespace Model;

use \W\Model\Model;

class PrivateMessageModel extends Model {
	/**
	 * Cette fonction renvoie un tableau contenant les informations du dernier message de chaque utilisateur qui a un fil de discussion ouvert avec l'utilisateur, ainsi que les informations relatives à cet utilisateur
	 *
	 * @param int $receiver_id L'id de l'utilisateur qui consulte sa messagerie
	 *
	 * @return array
	 */
	public function findMyMessages($receiver_id) {
		$this->setTable('private_messages');

		$sql = "SELECT mp1.*, users.firstname, users.lastname, tokens.token
				FROM private_messages mp1
                INNER JOIN users
				INNER JOIN tokens
				INNER JOIN
				(
				    SELECT max(post_date) MaxPostDate, author_id
				    FROM private_messages
				    GROUP BY author_id
				) mp2
					ON mp1.author_id = mp2.author_id
					AND mp1.post_date = mp2.MaxPostDate
				WHERE receiver_id = :receiver_id
                	AND users.id = mp1.author_id
					AND users.id = tokens.user_id
					AND tokens.type = 'MP'
				ORDER BY mp1.post_date DESC";

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':receiver_id', $receiver_id);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * Cette fonction envoie un message privé à tous les administrateurs du site.
	 *
	 * @param  int $objet   L'objet du message
	 * @param  int $email   L'adresse email du posteur
	 * @param  int $message Le message
	 *
	 * @return void
	 */
	public function contact($objet, $email, $message) {
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
