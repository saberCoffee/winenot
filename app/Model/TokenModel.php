<?php
namespace Model;

use \W\Model\Model as Model;

use \Model\UserModel;

class TokenModel extends Model
{
	protected $primaryKey = 'token';

	public function getIdbyToken($token)
	{
		return $this->getUserByToken($token);
	}

	public function getTokenById($id)
	{
		return $this->getUserById($id);
	}

	public function generateToken($idUser, $type = "Authentification")
	{
		$userModel = new UserModel();

		$token = md5(uniqid(rand(), true));		
		while ($userModel->tokenExists($token)) {
			$token = md5(uniqid(rand(), true));
		}

		/*
			DevNote : Si le token existe déjà, le supprimer et en générer un autre
		*/
		/*if ($this->tokenExists($idUser)) {
			echo "DELETER";
		}*/

		$data = array(
			'token'   => $token,
			'user_id' => $idUser,
			'type'    => $type
		);

		$this->insert($data);

		return $token;
	}


}
