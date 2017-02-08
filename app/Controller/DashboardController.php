<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\UserModel;
use \Model\WinemakerModel;
use \Model\PrivateMessageModel;

class DashboardController extends Controller
{

	/**
	 * Page d'accueil du dashboard
	 *
	 * @return void
	 */
	public function dashboard()
	{
		$this->show('dashboard/dashboard');
	}

	/**
	 * Page de création de newWineMaker
	 *
	 * @return void
	 */
	public function newWineMaker()
	{
		$this->show('dashboard/newWineMaker');
	}

	/**
	 * Page gérer/afficher sa cave
	 *
	 * @return void
	 */
	public function cave()
	{
		$this->show('dashboard/cave');
	}

	
	/**
	 * Page Ajouter un membre
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function addMember()
	{
		if (!empty($_POST)) {
			$error = array();
			
			$email          = htmlentities($_POST['email']);
			$password       = htmlentities($_POST['password']);
			$password_verif = htmlentities($_POST['password_verif']);
			$firstname      = htmlentities($_POST['firstname']);
			$lastname       = htmlentities($_POST['lastname']);
			$address        = htmlentities($_POST['address']);
			$city       	= htmlentities($_POST['city']);
			$postcode       = htmlentities($_POST['postcode']);
			$role       	= htmlentities($_POST['role']);
			$type       	= htmlentities($_POST['type']);
	
			if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
				$error['email'] = 'Cette adresse email est invalide.';
			}
	
			if (empty($password)) {
				$error['password'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($password) < 6) {
				$error['password'] = 'Vous devez utiliser au moins <strong>6</strong> caractères.';
			} elseif (strlen($password) > 16) {
				$error['password'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			} elseif ($password != $password_verif) {
				$error['password'] = 'Les mots de passe ne sont pas identiques.';
			}
	
			if (empty($firstname)) {
				$error['firstname'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($firstname) < 2) {
				$error['firstname'] = 'Vous devez utiliser au moins <strong>2</strong> caractères.';
			} elseif (strlen($firstname) > 16) {
				$error['firstname'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			}
	
			if (empty($lastname)) {
				$error['lastname'] = 'Vous devez remplir ce champ.';
			} elseif (strlen($lastname) < 2) {
				$error['lastname'] = 'Vous devez utiliser au moins <strong>2</strong> caractères.';
			} elseif (strlen($lastname) > 16) {
				$error['lastname'] = 'Vous ne pouvez pas utiliser plus de <strong>16</strong> caractères.';
			}
	
			$user = new UserModel;
	
			$user->registerFromAdmin($email, $password, $firstname, $lastname, $address, $city, $postcode, $role, $type, $error);
	
			
			if (empty($error)) {
				$_SESSION['msg'] = "L'utilisateur a bien été enregistré.";
				$this->redirectToRoute('members');
			}
		}
	
		$this->show('dashboard/members', array(
				'error' => (isset($error)) ? $error : '',
				'successMsg' =>  $successMsg,
				'email'     => (!empty($email)) ? $email : '',
				'firstname' => (!empty($firstname)) ? $firstname : '',
				'lastname'  => (!empty($lastname)) ? $lastname : '',
		));
	}
	
// 	public function addMember()
// 	{
// 		/*
// 		 DevNote : 
// 			*/
// 		if(!empty($_POST)) {
			
// 			$data = array (
// 				'id' => $_POST['id'],
// 				'firstname' => $_POST['firstname'],
// 				'lastname' => $_POST['lastname'],
// 				'email' => $_POST['email'],
// 				'password' => $_POST['password'],
// 				'address' => $_POST['address'],
// 				'city' => $_POST['city'],
// 				'postcode' => $_POST['postcode'],
// 				'role' => $_POST['role'],
// 				'type' => $_POST['type']
// 			);
// 		}
		
// 		$members = new UserModel();
// 		$members = $members->insert($data);
		
// 		$this->show ('dashboard/members', array(
// 				'members' => $members
// 		));
// 	}
	
	/**
	 * Page Gérer les membres
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function members()
	{
		/*
			DevNote : Penser à ajouter une vérification que l'utilisateur est bien connecté en tant qu'admin. Si ce n'est pas le cas, le rediriger.
		*/
		$members = new UserModel();
		$members = $members->findAll();

		$this->show ('dashboard/members', array(
			'members' => $members
		));
	}

	/**
	 * Traitement "Gérer les membres"
	 * Réservé à l'administration
	 *
	 * @return void
	 */
	public function members_edit() {
		/*
			DevNote : Penser à ajouter une vérification que l'utilisateur est bien connecté en tant qu'admin. Si ce n'est pas le cas, le rediriger.
		*/
		if(isset($_POST)){

			$member = new UserModel();
			$id = $member->find($_GET['id']);
			$member = $member->find('2620528902ee37259c51a57d2367dd67');
			debug($member);

			$data = array(
					'firstname' => strip_tags($_POST['firstname']),
			);

			$member->update($data, $id);
		}
	}

	/**
	 * Page Gérer les producteurs
	 * Réservée à l'administration
	 *
	 * @return void
	 */
	public function winemakers()
	{
		/*
			DevNote : Penser à ajouter une vérification que l'utilisateur est bien connecté en tant qu'admin. Si ce n'est pas le cas, le rediriger.
		*/
		$winemakers = new WinemakerModel();
		$winemakers = $winemakers->findAll();

		if(isset($_GET['id'])){
			$winemaker = new UserModel();
			$winemaker = $winemaker->find($_GET['winemakers_id']);

		}

		$this->show ('dashboard/winemakers', array(
			'winemakers' => $winemakers
		));
	}

	/**
	 * Page d'accueil de la messagerie du dashboard
	 *
	 * @return void
	 */
	public function inbox()
	{
		$user     = new UserModel();
		$messages = new PrivateMessageModel();

		$user     = $user->getUserByToken($_SESSION['user']['id']);
		$messages = $messages->getActiveThreads($user['id']);

		$count_unread_messages = 0;
		foreach ($messages as $message) {
			if (!$message['isRead']) $count_unread_messages++;
		}

		$this->show ('dashboard/inbox', array(
			'messages'              => $messages,
			'count_unread_messages' => $count_unread_messages
		));
	}

	/**
	 * Fils de discussion des utilisateurs
	 *
	 * @param  [type] $token [description]
	 * @return [type]        [description]
	 */
	public function inbox_thread($token)
	{
		$user     = new UserModel();
		$messages = new PrivateMessageModel();

		$user1 = $user->getUserByToken($_SESSION['user']['id']);
		$user1 = $user1['id']; // Correspond à mon ID d'utilisateur

		$user2 = $user->getUserByToken($token);
		$user2 = $user2['id']; // Correspond à l'ID de l'utilisateur avec qui j'ai un fil de discussion

		$messages = $messages->getMessagesFromThread($user1, $user2);

		/*
			Ce bout de code sert à attribuer une classe row à chaque auteur
		*/
		$i       = 0;
		$classes = array();
		// Afin de garder le même ordre pour les classes CSS, il faut inverser l'ordre de l'array car le premier utilisateur rencontré récupère la classe row1. Or, si un nouveau message est posté, l'ordre serait potentiellement inversé car le premier posteur serait peut-être différent du précédent.
		$messages = array_reverse($messages);
		foreach ($messages as $message) {
			if ($i == 0) {
				$subject = $message['subject'];
			}

			if (empty($classes[$message['firstname']])) {
				if (empty($classes)) {
					$classes[$message['firstname']] = 'row1';
				} else {
					$classes[$message['firstname']] = 'row2';
				}
			}

			$messages[$i]['classe'] = $classes[$message['firstname']];

			$i++;
		}
		$messages = array_reverse($messages);

		$this->show ('dashboard/thread', array(
			'messages' => $messages,
			'subject'  => $subject,
			'token'    => $token
		));
	}

	/**
	 * [inbox_posting description]
	 * @param  [type] $token [description]
	 * @return [type]        [description]
	 */
	public function inbox_posting($token)
	{
		$user    = new UserModel();
		$message = new PrivateMessageModel();

		$receiver_id = $user->getUserByToken($token);
		$receiver_id = $receiver_id['id'];

		$author_id = $user->getUserByToken($_SESSION['user']['id']);
		$author_id = $author_id['id']; // Correspond à mon ID d'utilisateur

		$message->sendMessage($receiver_id, $author_id, $_POST['subject'], $_POST['content']);

		$this->redirectToRoute('inbox_thread', ['id' => $token]);
	}

}
