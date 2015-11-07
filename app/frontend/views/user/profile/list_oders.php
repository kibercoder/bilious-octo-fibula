<?php
use common\models\Product;
?>
  
  <!-- order -->
      <section class="block order">
        <div class="block-container">
		
    		<h1>МОИ ЗАКАЗЫ</h1>
    		<table>
          <tbody>
          	<tr>
              <th>№пп</th>
              <th>Дата</th>
              <th>№ заказа</th>
              <th>стоимость</th>
              <th>Состояние</th>
              <th>дата исполнения</th>
           </tr>
           <?php foreach($orders as $k => $order): ?>
          	<tr>
              <td><?=$k+1?></td>
              <td><?=date('d.m.Y',strtotime($order['created_datetime']))?></td>
              <td class="red"><?=$order['id']?></td>
              <td><?=Product::priceFormat($order['summ'])?>&nbsp;<b>₽</b></td>
              <td>формируется</td>
              <td><?=date('d.m.Y',strtotime($order['finished_datetime']))?></td>
              <td><a href="#" class="but">Редактировать</a></td>
              <td><a href="#" class="but">Отменить</a></td>
           </tr>
           <?php endforeach;?>


          </tbody>
    		</table>
		
        </div>
      </section>
	<!-- /order -->  