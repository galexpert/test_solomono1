<?php defined("PRODUCTBOOK") or die("Access denied"); ?>
<?php
/**
 * Шаблон списка задач
 **/
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
				 <div class="form-group" style="width: 20%">
                        <label for="exampleFormControlSelect1">Сортировка</label>
                        <select class="form-control" id="filter_class">
                            <option value="price">Дешевші</option>
							<option value="priceDesc">Дорожчі</option>
                            <option value="name">по Алфавіту</option>
                            <option value="create_at">Нові</option>
                        </select>
                    </div>
				
						<div class="row prods">
							
							<?php foreach ($products as $prod) : ?>
							
		
 <div class="col-md-4" >
		
    <div class="card text-center" id="<?= htmlspecialchars($prod['id']) ?>">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal" data-name="<?= htmlspecialchars($prod['name']) ?>" ><?= htmlspecialchars($prod['name']) ?></h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title" data-price="<?= htmlspecialchars($prod['price']) ?>"><?= htmlspecialchars($prod['price']) ?><small class="text-muted"> $</small></h1>
        <ul class="list-unstyled">
          <li>Описание:<?= htmlspecialchars($prod['descr']) ?></li>
          <li class="cat-id" data-cat="<?= htmlspecialchars($prod['cat_id']) ?>">Категория ID: <?= htmlspecialchars($prod['cat_id']) ?></li>
          <li class="cat-date" data-date="<?= htmlspecialchars($prod['create_at']) ?>">Дата: <?= htmlspecialchars($prod['create_at']) ?></li>
          <li>Help center access</li>
        </ul>
		<button data-id="<?= htmlspecialchars($prod['id']) ?>" data-status="1"
                                        class="open-edited btn btn-success">В корзину
                                </button>
      </div>
    </div>
	</div>
	  <?php endforeach; ?>

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
    <script>

        $(document).ready(function () {
			var cid = localStorage.getItem('catId');
			
		
			if (window.performance) {
 
			if(cid){
				 var url = '<?=PATH?>cats?catid='+cid;
			alert(url);
			$(location).attr('href',url);
			localStorage.removeItem('catId');

				}
  
			}
			
			 /* форма редактирования */
            $('#form-edited').dialog({
                autoOpen: false,
                width: 450,
                modal: true,
                title: 'Добавити товар в корзину',
                resizable: false,
                draggable: false,
                show: {effect: 'slide', duration: 700},
                hide: {effect: 'explode', duration: 700},
                buttons: {
                    "Добавити товар": function () {
                        /*var taskEmail = $.trim($('#comment-author1').val());
                         var tackTitle = $.trim($('#comment-title').val());*/
                        var tackText = $.trim($('#comment-text1').val());
                        var id = $('input#taskid').val();
                        var status = $('input#status').val();
                     //  console.log($('#customCheck-'+ id +'').prop("checked"));

                        if ( $('#customCheck-'+ id +'').prop("checked") ){
                            var done = 1;
                        } else {
                            var done = 0;
                        }
                       // console.log(done);

                        //var productId = <? echo 0 ?>;
                        if (tackText == '') {
                            alert('Все поля обязательны к заполнению');
                            return;
                        }

                        $('#comment-text').val('');
                        $(this).dialog('close');
                        $.ajax({
                            url: '<?=PATH?>add_task',
                            type: 'POST',
                            data: {editid: id, editText: tackText, status: status, done: done},
                            beforeSend: function () {
                                $('#loader').fadeIn();
                            },
                            success: function (res) {
                                var result = JSON.parse(res);

                                if (result.answer == 'Комментарий добавлен!') {
                                    // если комментарий добавлен
                                    var showComent = '<div class="new-task">' + result.code + '</div>';
                                    console.log($('.container.task').children('[id =' + result.id + ']'));
                                    //var showComent = result.code;
                                    //	$('.card.text-center:last').append(showComent);


                                    if ($('.container.task').children('[id =' + result.id + ']').length > 0) {
                                        // если это не ответ
                                        //	$('.container.task').children('[id ='+result.id+']').html(showComent);
                                        $('.container.task').children('[id =' + result.id + ']').children('.card-body').children('p.card-text').html(showComent);
                                    } else {
                                        $('.container.task').append(showComent);
                                    }
                                    $('.new-task').delay(1000).show('shake', 1000);
                                } else {
                                    // если комментарий не добавлен
                                    $('#errors').text(result.answer);
                                    $('#errors').delay(1000).queue(function () {
                                        $(this).dialog(opt).dialog('open');
                                        $(this).dequeue();
                                    });

                                }
                            },
                            error: function () {
                                alert("Ошибка!");
                            },
                            complete: function () {
                                $('#loader').delay(1000).fadeOut();
                            }
                        });
                    },
                    "Отмена": function () {
                        $(this).dialog('close');
                        $('#comment-text').val('');
                    }
                }
            });
			
			
			//.on('click', 'a', function(e)
			   $('div.row.prods').on('click', '.open-edited.btn.btn-success', function() {
                $('#form-edited').dialog('open');
                var status = $(this).data("status");
                var id = $(this).data("id");

				
                //var text = $(this).parent().siblings(".card-body").find('p.card-text').text();
				var name = $(this).parent().parent().find('div.card-header h4.my-0.font-weight-normal').data('name');
				var price = $(this).parent().find('h1.card-title.pricing-card-title').data("price");
				var catID = $(this).parent().find('ul.list-unstyled li.cat-id').data("cat");
				var date = $(this).parent().find('ul.list-unstyled li.cat-date').data("date");
                $this = $(this);
                if (!parseInt(parent)) parent = 0;
				console.log($(this).parent().siblings(".card-header").find('h4.my-0.font-weight-normal').data("name"));
               $('div#form-edited h4.my-0.font-weight-normal').text(name);
			   $('div#form-edited h1.card-title.pricing-card-title').text(price);
			    $('div#form-edited ul.list-unstyled li.cat-id').text(catID);
				 $('div#form-edited ul.list-unstyled li.cat-date').text(date);

            });

            $('select#filter_class').on('change', function() {
            // alert( this.value );

                var ids = $('div.row.prods').find('div.card.text-center').map(function() {
                    return $(this).attr('id');
                }).get();

            // console.log(ids);
			// alert(ids);
                $.ajax({
                    url: '<?=PATH?>ajax',
                    type: 'POST',
                    data: {sortParams: this.value, taskId: ids },
                    success: function (res) {
                       var result = JSON.parse(res);                 

                       if (result.answer1 == 'good') {
                            // если комментарий добавлен
                            //var showComent = '<div class="new-task">' + result.code + '</div>';
							var showComent = result.code;

                          $('div.col-md-8 div.row.prods').html(showComent);
                     
                           // $('div.col-md-8 div.row.prods').show('shake', 1000);
                        } else {
                            // если комментарий не добавлен
                            $('#errors').text(result.answer);
                            $('#errors').delay(1000).queue(function () {
                               // $(this).dialog('open');
                               // $(this).dequeue();
                            });

                        }
                    },
                    error: function () {
                        alert("Ошибка!");
                    },
                    complete: function () {
                      //  $('#loader').delay(1000).fadeOut();
                    }
                }); 
            });
			
			

			
			   $('div.sidebar li a.text-muted').on('click', function(e) {
            //alert( this.value );
               e.preventDefault();
                /* var id = $(e.target.search, 'href').map(function() {
                    //return $(this).attr('href');
					//return $(this);
                }).get(); */
				
				
				
				var param = $(e.target).attr('href'); 
                var arr = param.split('=');
				var catId = arr[1];
				if (catId) {
				//	$.cookie("catId", catId);
					localStorage.setItem("catId" , catId);
				 $.ajax({
                    url: '<?=PATH?>ajax',
                    type: 'POST',
                    data: {catID: catId },
                    success: function (res) {
                       var result = JSON.parse(res);                 

                       if (result.answer1 == 'good') {
                            // если комментарий добавлен
                            //var showComent = '<div class="new-task">' + result.code + '</div>';
							var showComent = result.code;

                          $('div.col-md-8 div.row.prods').html(showComent);
                     
                           // $('div.col-md-8 div.row.prods').show('shake', 1000);
                        } else {
                            // если комментарий не добавлен
                            $('#errors').text(result.answer);
                            $('#errors').delay(1000).queue(function () {
                               // $(this).dialog('open');
                               // $(this).dequeue();
                            });

                        }
                    },
                    error: function () {
                        alert("Ошибка!");
                    },
                    complete: function () {
                      //  $('#loader').delay(1000).fadeOut();
                    }
                }); 	
	
}
               
            });
			
			


        });


    </script>
</body>
</html>