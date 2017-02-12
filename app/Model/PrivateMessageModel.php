<?php
namespace Model;

use \W\Model\Model;
use \Model\UserModel;

class PrivateMessageModel extends Model {
	/**
	 * Cette fonction renvoie un tableau contenant les informations du dernier message de chaque utilisateur qui a un fil de discussion ouvert avec l'utilisateur, ainsi que les informations relatives à cet utilisateur
	 *
	 * @param int $receiver_id L'id de l'utilisateur qui consulte sa messagerie
	 *
	 * @return array
	 */
	public function getActiveThreads($receiver_id) {
		$this->setTable('private_messages');

		$sql = "SELECT
					mp1.*, users.firstname, users.lastname, tokens.token as mp_token
				FROM
					$this->table mp1
                INNER JOIN
					users
				INNER JOIN
					tokens
				INNER JOIN
				(
				    SELECT max(post_date) MaxPostDate, author_id
				    FROM $this->table
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

	public function getMessagesFromThread($user1, $user2) {
		$this->setTable('private_messages');

		$sql = "SELECT private_messages.*, users.firstname, users.lastname
			FROM
				private_messages
			INNER JOIN
				users
			WHERE `receiver_id` = :user1
				AND `author_id` = :user2
				AND users.`id` = :user2
			OR `author_id`= :user1
				AND `receiver_id` = :user2
				AND users.`id` = :user1
			ORDER BY `post_date` DESC";

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':user1', $user1);
		$sth->bindValue(':user2', $user2);
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
	public function contact($subject, $email, $content) {
		$this->setTable('private_messages');

		$admins = new UserModel();
		$admins = $admins->getAllAdmins();

		$content = 'Adresse mail de l\'utilisateur : ' . $email . '' . $content;

		$data = array(
			'author_id'		=> -1, // -1 correspond à l'id d'un invité
			'subject'   	=> $subject,
			'content' 		=> $content
		);

		foreach($admins as $admin) {
			$data['receiver_id'] = $admin['id'];

			$this->insert($data);
		}
	}

	public function sendMessage($receiver_id, $author_id, $subject, $content)
	{
		$this->setTable('private_messages');

		$data = array(
			'receiver_id'	=> $receiver_id,
			'author_id'		=> $author_id,
			'subject'   	=> $subject,
			'content' 		=> $content
		);

		return $this->insert($data);
	}

}
