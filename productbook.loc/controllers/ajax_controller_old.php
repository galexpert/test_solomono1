<?php defined("PRODUCTBOOK") or die("Access denied");

include "models/category_model.php";


if (isset($_POST['sortParams'])){

    echo sort_task();
} elseif (isset($_POST['catID'])){
	
	 echo get_ajaxProds();

	
	
	
}






