<?php defined("PRODUCTBOOK") or die("Access denied");


/**
 * редирект после авторизации
 **/

function redirect(){
	$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;

	header("Location: $redirect");
	exit;
}
/**
 * получение списка задач
 **/

function get_task(){
	global $connection;
	$query = "SELECT * FROM tasks ORDER BY id";
	$res = mysqli_query($connection, $query);
	$tasks = array();
	while($row = mysqli_fetch_assoc($res)){
		$tasks[$row['id']] = $row;
	}
	return $tasks;
}

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
	
	$query = "SELECT c.id,c.name AS name,c.alias, count(*) AS cnt
FROM products AS p
INNER JOIN categories c ON p.cat_id = c.id
GROUP BY p.cat_id";

	$res = mysqli_query($connection, $query);
	$categories = array();
	while($row = mysqli_fetch_assoc($res)){
		//$categories[$row['id']] = $row;
		$categories[] = $row;
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
	$res = get_products($id);
	
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





/*=========Пагинация==========*/

// кол-во товаров на страницу
$perpage = 4;

// общее кол-во товаров
$count_tasks = count_tasks();

// необходимое кол-во страниц
$count_pages = ceil($count_tasks / $perpage);
// минимум 1 страница
if( !$count_pages ) $count_pages = 1;


if( isset($_GET['page']) ){
	$page = (int)$_GET['page'];
	if( $page < 1 ) $page = 1;
}else{
	$page = 1;
}


if( $page > $count_pages ) $page = $count_pages;


$start_pos = ($page - 1) * $perpage;

$pagination = pagination($page, $count_pages);

/*=========Пагинация==========*/



/**
 * Получение нужного колличества задач SELECT * FROM tasks ORDER BY id
 **/
function get_taskPage($start_pos, $perpage){
	global $connection;
	$query = "SELECT * FROM tasks ORDER BY id LIMIT $start_pos, $perpage";
	$res = mysqli_query($connection, $query);
	$tasks = array();
	while($row = mysqli_fetch_assoc($res)){
		$tasks[] = $row;
	}
	return $tasks;
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

/**
 * Постраничная навигация
 **/
function pagination($page, $count_pages){


	$uri = "?";

	if( $page > 1 ){
		$back = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>&lt;</a>";
	}
	if( $page < $count_pages ){
		$forward = "<a class='nav-link' href='{$uri}page=" .($page+1). "'>&gt;</a>";
	}
	if( $page > 3 ){
		$startpage = "<a class='nav-link' href='{$uri}page=1'>&laquo;</a>";
	}
	if( $page < ($count_pages - 2) ){
		$endpage = "<a class='nav-link' href='{$uri}page={$count_pages}'>&raquo;</a>";
	}

	if( $page - 1 > 0 ){
		$page1left = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>" .($page-1). "</a>";
	}
	if( $page + 1 <= $count_pages ){
		$page1right = "<a class='nav-link' href='{$uri}page=" .($page+1). "'>" .($page+1). "</a>";
	}


	return $startpage.$back.$page1left.'<a class="nav-active">'.$page.'</a>'.$page1right.$forward.$endpage;
}

?>