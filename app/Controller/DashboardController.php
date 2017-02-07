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

		if(isset($_GET['id'])){
			$member = new UserModel();
			$member = $member->find($_GET['id']);
		}

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
		$messages = $messages->findMyMessages($user['id']);

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
		$this->show ('dashboard/thread', array(

		));
	}

}
