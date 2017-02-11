<?php
namespace Model;

use \W\Model\Model as Model;

use \Model\UserModel;

class TokenModel extends Model
{
	protected $primaryKey = 'token';

	public function generateToken($idUser, $type = "Authentification")
	{
		$userModel = new UserModel();

		$token = md5(uniqid(rand(), true));
		while ($userModel->tokenExists($token)) {
			$token = md5(uniqid(rand(), true));
		}

		// Si l'utilisateur a déjà un token, il faut supprimer l'ancien
		$oldToken = $userModel->getTokenByUserId($idUser);
		if ($oldToken) {
			$this->delete($oldToken);
		}

		$data = array(
			'token'   => $token,
			'user_id' => $idUser,
			'type'    => $type
		);

		$this->insert($data);

		return $token;
	}


}
