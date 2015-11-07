<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <div class="col-xs-7">
     <h1>Главные новости</h1>
     <?php foreach ($main_posts as $post): ?>
      <div class="well">
        <a href="/news/<?php echo $post->id?>"><h2><?php echo $post->title;?></h2></a>
        <p><?= $post->created_date ?></p>
        
        <?php if ($post->preview_image) { ?>
        <div><img style="width:100%" src="/uploads/post/image_file/<?= $post->id?>/<?= $post->preview_image?>"></div>
        <?php } ?>
        
        <div>
        <?php
          $size = 1200;
          $short = mb_substr(strip_tags($post->body),0,$size,"utf-8");
          echo mb_strlen($short,'utf-8') < $size ? strip_tags($post->body) : $short.'...';
        ?>
        </div>
      </div>
     <?php endforeach ?>
    </div>

    <div class="col-xs-5">
      <h1><?= Html::encode($this->title) ?></h1>
      <?php foreach ($all_posts as $post): ?>
      <div class="well">
        <a href="/news/<?php echo $post->id?>"><h3><?php echo $post->title;?></h3></a>
        <p><?php echo $post->created_date?></p>
        
        <?php if ($post->preview_image) { ?>
        <div><img style="width:100%" src="/uploads/post/image_file/<?= $post->id?>/<?= $post->preview_image?>"></div>
        <?php } ?>

        <div><?php echo mb_substr(strip_tags($post->body),0,200,"utf-8");?>...</div>
      </div>
      <?php endforeach ?>
      <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>

</div>
