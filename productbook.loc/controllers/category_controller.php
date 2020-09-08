<?php defined("PRODUCTBOOK") or die("Access denied");

require_once "models/{$view}_model.php";
require_once "views/{$view}_view.php";

class category_controller {
	
	
		function getId() {	
				if ($_GET['catid']){
				$id = (int) $_GET['catid'];
					}
		return $id;
		}
		
		function Products () {
			$model = new category_model();
			$products = $model->get_products($this->getId());
		return $products;
		}
		
		function Categories () {
		$model = new category_model();

		$cats = $model->get_cats();
		return $cats;
		}
		
	
}


?>