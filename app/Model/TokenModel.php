<?php
namespace Model;

use \W\Model\Model as Model;

class TokenModel extends Model
{

	public function getIdbyToken($token)
	{	
		return $this->getUserByToken($token);
	}
	public function generateToken($idUser, $type = "Authentification")
	{
		/*if ($this->tokenExists($idUser)) {
			echo "DELETER";
		}*/

		$this->setTable("tokens");
		
		$token = md5(uniqid(rand(), true));
		
		$data = array(
				'token'       => $token,
				'user_id' => $idUser
		);

		$this->insert($data);
		
		return $token;
	}


}
