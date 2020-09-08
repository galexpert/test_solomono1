<?php defined("PRODUCTBOOK") or die("Access denied");


/**
 * редирект после авторизации
 **/
class array_model {
 
function redirect(){
	$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;

	header("Location: $redirect");
	exit;
}
/**
 * получение списка задач
 **/


function get_products($id = NULL){
	if ($id) {
	$where .= " WHERE cat_id = $id AND published = 1 ";
} else {
	$where .= " WHERE published = 1 ";
}
	global $connection;
	
	
	$query = "SELECT * FROM products $where ORDER BY id";
	$res = mysqli_query($connection, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($res)){
		$products[$row['id']] = $row;
	}
	return $products;
}

function get_cats(){
	global $connection;
	
	//$query = "SELECT * FROM categories ORDER BY id";
	
	$query = "SELECT p.categorie_id AS cat_id ,p.parent_id FROM categorie AS p";

if ($result = $connection->query($query)) {

    /* выборка данных и помещение их в массив */
	$categories =  array();
    while ($row = $result->fetch_assoc()) {

	   if(empty($categories[$row['parent_id']])){
		$categories[$row['parent_id']] = array();
	   }
	  
	   $categories[$row['parent_id']][] = $row;
	   
    }
	//ksort($categories);
	

}	

	
	return $categories;
}

function sort_task(){
	foreach ($_POST as $key => $value) {
		//$value = $jfilter->clean($value, 'STRING');
		$_POST[$key] = str_replace(array('\'', '"', ',', '%', '*','//', '\\', '?', '^', '`', '{', '}', '|', '~', '(', ')', '$', '&', '<', '>', ';', '[', ']'), array(''), $value);
	}
	global $connection;
	$sortParam = trim(mysqli_real_escape_string($connection, $_POST['sortParams']));
	$taskIds = $_POST['taskId'];

	if(empty($sortParam) ){
	//	$res = array('answer' => 'Нет параметра сортировки');
	//	return json_encode($res);
	}

if ($sortParam == 'price'){
	$sortField = 'price';

}elseif ($sortParam == 'priceDesc'){
	$sortField = 'price';
	$desc = 'DESC';

}elseif ($sortParam == 'name'){
	$sortField = 'name';

}elseif($sortParam == 'create_at'){
	$sortField = 'create_at';

}else{
	$sortField = 'name';
	//$res = array('answer' => 'Нет параметра сортировки');
	//return json_encode($res);
}
	$ids = implode(",", $taskIds);
	//print_r($ids);
	if(!empty($desc)){
$oreder .= " ORDER BY `$sortField` DESC";
} else {
	$oreder .= " ORDER BY `$sortField`";
}
	
	$query = "SELECT * FROM `products` WHERE `id` IN ($ids) AND published = 1 $oreder";
	


	$res = mysqli_query($connection, $query);
	$tasks = mysqli_fetch_all($res, MYSQLI_ASSOC);

//var_dump($tasks);

	if (count($taskIds) > 1){

		if(mysqli_affected_rows($connection) > 0){

			$comment_html = '';
		 	
			foreach ($tasks as $prod) {
				//ob_start();
				$comment_html .= "<div class='col-md-4'>";
				$comment_html .= "<div id ='".htmlspecialchars($prod['id'])."' class='card text-center'>";
				$comment_html .= "<div class='card-header'>";
				$comment_html .= "<h4 class='my-0 font-weight-normal' data-name='" . htmlspecialchars($prod['name']). "'>" . htmlspecialchars($prod['name']) . "</h4>";
				$comment_html .= "</div>";
				$comment_html .= "<div class='card-body'>";
				$comment_html .= "<h1 class='card-title pricing-card-title' data-price='" . htmlspecialchars($prod['price']). "'>" . htmlspecialchars($prod['price']) . "<small class='text-muted'> $</small></h1>";
				$comment_html .= "</div>";
				$comment_html .= "<ul class='list-unstyled'>";
				$comment_html .= "<li>Описание" . htmlspecialchars($$prod['descr']) . "</li>";
				$comment_html .= "<li class='cat-id' data-cat='" . htmlspecialchars($prod['cat_id']). "'>Категория ID" . htmlspecialchars($prod['cat_id']) . "</li>";
				$comment_html .= "<li class='cat-date' data-date='" . htmlspecialchars($prod['create_at']). "'>Дата " . htmlspecialchars($prod['create_at']) . "</li>";
				$comment_html .= "<li>Help center access</li>";
				$comment_html .= "</ul>";
				$comment_html .= "<button data-id=" . htmlspecialchars($prod['id']) . " data-status='1'
                                        class='open-edited btn btn-success'>В корзину
                                </button>";
				$comment_html .= "</div>";
				$comment_html .= "</div>";
			} 
			
		
			$res = array('answer1' => 'good', 'code' => $comment_html);

		}else{
			$res = array('answer' => 'Ошибка добавления комментария');
			return json_encode($res);
		}
		return json_encode($res);
	}

}




function get_ajaxProds(){

if ($_POST['catID']){
	$id = (int) $_POST['catID'];
	$res = $this->get_products($id);
	
}
	//get_products($id);


	//$res = mysqli_query($connection, $query);
	//$tasks = mysqli_fetch_all($res, MYSQLI_ASSOC);

//var_dump($res);

	if ($_POST['catID']){

		if($res){

			$comment_html = '';
		 	
			foreach ($res as $prod) {
				//ob_start();
				$comment_html .= "<div class='col-md-4'>";
				$comment_html .= "<div id ='".htmlspecialchars($prod['id'])."' class='card text-center'>";
				$comment_html .= "<div class='card-header'>";
				$comment_html .= "<h4 class='my-0 font-weight-normal' data-name='" . htmlspecialchars($prod['name']). "'>" . htmlspecialchars($prod['name']) . "</h4>";
				$comment_html .= "</div>";
				$comment_html .= "<div class='card-body'>";
				$comment_html .= "<h1 class='card-title pricing-card-title' data-price='" . htmlspecialchars($prod['price']). "'>" . htmlspecialchars($prod['price']) . "<small class='text-muted'> $</small></h1>";
				$comment_html .= "</div>";
				$comment_html .= "<ul class='list-unstyled'>";
				$comment_html .= "<li>Описание" . htmlspecialchars($prod['descr']) . "</li>";
				$comment_html .= "<li class='cat-id' data-cat='" . htmlspecialchars($prod['cat_id']). "'>Категория ID" . htmlspecialchars($prod['cat_id']) . "</li>";
				$comment_html .= "<li class='cat-date' data-date='" . htmlspecialchars($prod['create_at']). "'>Дата " . htmlspecialchars($prod['create_at']) . "</li>";
				$comment_html .= "<li>Help center access</li>";
				$comment_html .= "</ul>";
				$comment_html .= "<button data-id=" . htmlspecialchars($prod['id']) . " data-status='1'
                                        class='open-edited btn btn-success'>В корзину
                                </button>";
				$comment_html .= "</div>";
				$comment_html .= "</div>";
			} 
			
		
			$res = array('answer1' => 'good', 'code' => $comment_html);

		}else{
			$res = array('answer' => 'Ошибка добавления комментария');
			return json_encode($res);
		}
		return json_encode($res);
	}

}



/**
 * Кол-во товаров
 **/
function count_tasks(){
	global $connection;
	$query = "SELECT COUNT(*) FROM tasks";
/*	if( !$ids ){
		$query = "SELECT COUNT(*) FROM products";
	}else{
		$query = "SELECT COUNT(*) FROM products WHERE parent IN($ids)";
	}*/
	$res = mysqli_query($connection, $query);
	$count_tasks = mysqli_fetch_row($res);
	return $count_tasks[0];
}



	
}
 
 


?>