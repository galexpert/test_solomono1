<?php defined("PRODUCTBOOK") or die("Access denied");

include "models/{$view}_model.php";

if ($_GET['catid']){
$id = (int) $_GET['catid'];
}

$products = get_products($id);
$cats = get_cats();

//$taskList = get_taskPage($start_pos, $perpage);
include "views/{$view}_view.php";

?>