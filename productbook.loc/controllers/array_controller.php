<?php defined("PRODUCTBOOK") or die("Access denied");

require_once "models/{$view}_model.php";
require_once "models/category_model.php";
require_once "views/{$view}_view.php";



class array_controller {
	
	
		/* function getId() {	
				if ($_GET['catid']){
				$id = (int) $_GET['catid'];
					}
		return $id;
		} */
		
	/* 	function Products () {
			$model = new category_model();
			$products = $model->get_products($this->getId());
		return $products;
		} */
		
		function Categories () {
		$model = new category_model();

		$cats = $model->get_cats();
		return $cats;
		}
		
		function getArrCats () {
		$model = new array_model();

		$result = $model->get_cats();
		return $result;
		}
		
		function view_cat($arr,$parent_id = 0) {
 
			 //Условия выхода из рекурсии
			 if(empty($arr[$parent_id])) {
			  return;
			 }
			 echo '<ul>';
			 //перебираем в цикле массив и выводим на экран
			 for($i = 0; $i < count($arr[$parent_id]);$i++) {
				
			  echo '<li>'.$arr[$parent_id][$i]['cat_id'].'={array}'.$arr[$parent_id][$i]['cat_id'];
			 // print_r($arr[$parent_id]);
			 
			  
			  //echo '----'.$arr[$parent_id][$i];
			// var_dump($arr[$parent_id][$i]);
			  //рекурсия - проверяем нет ли дочерних категорий
			  $this->view_cat($arr,$arr[$parent_id][$i]['cat_id']);
			  echo '</li>';
			 }
			 echo '</ul>';
 
		}
		
}


?>