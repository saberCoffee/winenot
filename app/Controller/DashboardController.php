<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UserModel;
use W\Security\AuthentificationModel;
use Model\WinemakerModel;

class DashboardController extends Controller
{

	/**
	 * Page d'accueil du dashboard
	 */
	public function dashboard()
	{
		$this->show('dashboard/dashboard');
	}

	/**
	 * Page de création de newWineMaker
	 */
	public function newWineMaker()
	{
		$this->show('dashboard/newWineMaker');
	}

	/**
	 * Page gérer/afficher sa cave
	 */
	public function cave()
	{
		$this->show('dashboard/cave');
	}
	
	/**
	 * Page gérer/afficher les membres
	 *
	 */
	public function members() 
	{


		$members = new UserModel();
		$members = $members->findAll();

		// debug($members);
		
	
		if(isset($_GET['id'])){
			$member = new UserModel();
			$member = $member->find($_GET['id']);
	
		}

		$this->show ('dashboard/members', ['members' => $members]);
	}
	
	public function winemakers()
	{
		$winemakers = new WinemakerModel();
		$winemakers = $winemakers->findAll();
		
		if(isset($_GET['id'])){
			$winemaker = new UserModel();
			$winemaker = $winemaker->find($_GET['winemakers_id']);
		
		}
		
		$this->show ('dashboard/winemakers', ['winemakers' => $winemakers]);
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
