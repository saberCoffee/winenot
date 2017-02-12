<?php
namespace Model;

use \W\Model\Model;

class MagModel extends Model 
{
	/**
	 * Cette fonction récupère tous les détails de la table mag 
	 *
	 * @return array
	 */
	public function allArticles() {
		
		$this->setTable('mag');
		
		return $this->findAll();
		
	}
}