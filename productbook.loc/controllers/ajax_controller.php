<?php defined("PRODUCTBOOK") or die("Access denied");

require_once "models/category_model.php";
	
		$model = new category_model();
		
		if (isset($_POST['sortParams'])){

			echo $model->sort_task();
		} elseif (isset($_POST['catID'])){
	
			echo $model->get_ajaxProds();
		}

