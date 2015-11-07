<?php
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about col-xs-12">

    <h1><?= $model->title?></h1>
    <p><?= $model->created_date?></p>
    
    <?php if ($model->preview_image) { ?>
      <div><img style="max-width:740px" src="/uploads/post/image_file/<?= $model->id?>/<?= $model->preview_image?>"></div>
    <?php } ?>
    
    <div>&nbsp;</div>
    
    <div><?= $model->body?></div>
</div>
