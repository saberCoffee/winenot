<?php
namespace Model;

use \W\Model\Model;

use \Model\UserModel;

class ProductModel extends Model {
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
	public function addProduct($token, $name, $color, $price, $millesime, $cepage, $stock, $bio)
	{
		$user = new UserModel();

		$winemaker_id = $user->getUserByToken($token);

		$data = array(
			'name'		   => $name,
			'couleur'	   => $color,
			'price'   	   => $price,
			'millesime'    => $millesime,
			'cepage' 	   => $cepage,
			'stock' 	   => $stock,
			'is_bio' 	   => $bio,
			'winemaker_id' => $winemaker_id
		);

		return $this->insert($data);
	}

	public function editProduct($idProduct, $price, $stock)
	{
		$data = array(
			'price' => $price,
			'stock' => $stock
		);

		return $this->update($data, $idProduct);
	}
}
