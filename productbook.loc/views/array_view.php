<?php defined("PRODUCTBOOK") or die("Access denied"); ?>
<?php
/**
 * Шаблон списка задач
 **/
$controller = new array_controller();

//$products = $controller->Products();
$cats = $controller->Categories();

$catArr = $controller->getArrCats();
//var_dump($catArr);
 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><? //echo strip_tags($breadcrumbs)?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= PATH ?>views/style.css">
    <link rel="stylesheet" href="<?= PATH ?>views/css/smoothness/jquery-ui-1.12.1.min.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

</head>
<body>





<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
	
    <div class="jumbotron">
        <div class="container task">
            <div class="row">
                <div class="col-md-4">
            <div class="sidebar">
                <?php include "views/sidebar_cat.php"; 
				
				?>
            </div>
            </div>
                <div class="col-md-8">
				<?php echo '<div style="width:300px;float:left; padding:10px; border:1px solid #074776">';
$controller->view_cat($catArr);
echo '</div>';?>
				
						<div class="row prods">
							


	</div>
			

</div>
           
			
			
			

			
			
	 </div>		
			
			
			
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

</main>

	

<footer class="container">
    <p>&copy; Company 2017-2019</p>
</footer>


   <div id="form-edited" class="col-md-12">
        <form action="<?= PATH ?>add_task" method="post" class="form">

    <div class="card text-center" id="<?= htmlspecialchars($prod['id']) ?>">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal"><?= htmlspecialchars($prod['name']) ?></h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title"><?= htmlspecialchars($prod['price']) ?><small class="text-muted"> $</small></h1>
        <ul class="list-unstyled">
          <li>Описание:<?= htmlspecialchars($prod['descr']) ?></li>
          <li class="cat-id">Категория ID: <?= htmlspecialchars($prod['cat_id']) ?></li>
          <li class="cat-date">Дата: <?= htmlspecialchars($prod['create_at']) ?></li>
          <li>Help center access</li>
        </ul>
		
      </div>
    </div>
	

            <input type="hidden" id="status" name="status" value="0">
            <input type="hidden" id="taskid" name="taskid" value="0">

            <!--<p class="submit">
                <input type="submit" value="Добавить отзыв" name="submit">
            </p>-->
            <!--<button class="btn btn-primary" type="submit">Submit form</button>-->
        </form>
    </div>

    <div id="loader"><span></span></div>
    <div id="errors"></div>


    <script src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="<?= PATH ?>views/js/jquery-ui_1.12.1.min.js"></script>
    <script src="<?= PATH ?>views/js/jquery.accordion.js"></script>
    <script src="<?= PATH ?>views/js/jquery.cookie.js"></script>
    
</body>
</html>