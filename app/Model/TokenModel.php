<?php
namespace Model;

use \W\Model\Model as Model;

use \Model\UserModel;

class TokenModel extends Model
{

	protected $primaryKey = 'token';

	/**
	 * Cette fonction génère un token (généralement à l'inscription et à la connexion)
	 *
	 * @param  string $idUser L'id de l'utilisateur
	 * @param  string $type   Le type du token : Authentification (qui sera utilisé dans la grande majorité des cas), MP (qui sera utilisé pour le service de messagerie du site) et Email (qui serait idéalement utilisé lors d'envoi de mails pour la récupération de mot de passe, ce que nous ne feront pas dans ce projet)
	 *
	 * @return string         Le token généré
	 */
	public function generateToken($idUser, $type = 'Authentification')
	{
		$userModel = new UserModel();

		$token = md5(uniqid(rand(), true));
		while ($userModel->tokenExists($token)) {
			$token = md5(uniqid(rand(), true));
		}

		// Si le token qu'on souhaite générer est de type Authentification, on va en créer un et supprimer l'ancien (s'il y en a). Ainsi, à chaque nouvelle connexion, on aura un token tout neuf !
		if ($type == 'Authentification') {
			// Si l'utilisateur a déjà un token, il faut supprimer l'ancien
			$oldToken = $userModel->getTokenByUserId($idUser);

			if ($oldToken) {
				$this->delete($oldToken);
			}
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
