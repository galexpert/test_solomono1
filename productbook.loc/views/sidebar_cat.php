<?php defined("PRODUCTBOOK") or die("Access denied"); ?>
<?php
/**
 * Шаблон формы авторизации
 **/


 ?>
<div class="row">
      <div class="col-12 ">
        <h5>Categories</h5>
		
        <ul class="list-unstyled text-small">
		<li><a class="1text-muted" href="/cats"><?= 'Всі товари' ?></a></li>
		<?php foreach ($cats as $cat) : ?>
          <li><a class="text-muted" href="/cats?catid=<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']).' ('.$cat['cnt'].')' ?></a></li>
		  <?php endforeach; ?>
        </ul>
      </div>
	  <div class="col-12 ">
        <h5>Завтання 2 Array Categories</h5>
		
        <ul class="list-unstyled text-small">
		<li><a class="1text-muted" href="/array"><?= 'Массив категорій' ?></a></li>
        </ul>
      </div>
   
    </div>

