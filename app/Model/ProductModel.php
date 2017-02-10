<?php
namespace Model;

use \W\Model\Model;

use \Model\UserModel;

class ProductModel extends Model
{

	/**
	 * Cette fonction insert les produits du producteur dans la bdd.
	 *
	 * @param 	int $product  	nom du produit
	 * @param 	int $color    	couleur du vin
	 * @param 	int $price    	tarif de la bouteille
	 * @param 	int $millesime  l'année
	 * @param 	int $cepage   	cépage du vin
	 * @param 	int $stock    	si c'est en stock
	 * @param 	int $bio    	si le vin est bio
	 *
	 * @return void
	 */
	public function addProduct($token, $name, $color, $region, $price, $description, $millesime, $cepage, $stock, $bio)
	{
		$user = new UserModel();

		$winemaker_id = $user->getUserByToken($token);

		$data = array(
			'name'		   => $name,
			'couleur'	   => $color,
			'region'       => $region,
			'price'   	   => $price,
			'description'  => $description,
			'millesime'    => $millesime,
			'cepage' 	   => $cepage,
			'stock' 	   => $stock,
			'is_bio' 	   => $bio,
			'winemaker_id' => $winemaker_id['id']
		);

		return $this->insert($data);
	}

	public function editProduct($idProduct, $price, $description, $stock)
	{
		$data = array(
			'price'       => $price,
			'description' => $description,
			'stock'       => $stock
		);

		return $this->update($data, $idProduct);
	}

	/**
	 * Retourne tous les produits d'un producteurs
	 *
	 * @param  [int] $winemaker_id   L'id d'un producteur
	 *
	 * @return [array]               Un array contenant toutes les informations des produits d'un producteur
	 */
	public function findProductsFrom($winemaker_id)
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE winemaker_id = :winemaker_id';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':winemaker_id', $winemaker_id);

		$sth->execute();

		return $sth->fetchAll();
	}

}
