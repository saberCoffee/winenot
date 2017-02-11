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

		if ($userModel->getTokenByUserId($idUser)) {  // Si l'utilisateur a déjà un token, on le met à jour
			$data = array(
				'token' => $token,
			);

			$sql = 'UPDATE ' . $this->table . ' SET token = :token WHERE user_id = :id';
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(':id', $idUser);
			$sth->bindValue(':token', $token);

			if(!$sth->execute()){
				return false;
			}
		} else { // Sinon, si l'utilisateur n'a pas encore de token
			$data = array(
				'token'   => $token,
				'user_id' => $idUser,
				'type'    => $type
			);

			$this->insert($data);
		}

		return $token;
	}


}
