<?php
namespace Model;

use \W\Model\Model;

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
	public function addProduct($id, $products, $color, $price, $millesime, $cepage, $stock, $bio)
	{
		$this->setTable('products');
		
		$data = array(
			'winemakers_id'	=> $id,
			'name'			=> $products,
			'couleur'		=> $color,
			'price'   		=> $price,
			'millesime' 	=> $millesime,
			'cepage' 		=> $cepage,
			'stock' 		=> $stock,
			'is_bio' 		=> $bio

		);

		return $this->insert($data);
	}

}



