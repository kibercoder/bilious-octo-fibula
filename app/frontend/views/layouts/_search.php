<?php
  use yii\helpers\ArrayHelper;
  use common\models\Specialist;
  use common\models\SpecialistType;
  use common\models\Product;
  use common\models\ProductType;
  use common\models\ProductCat;
  use common\models\Diagnos;
  use common\models\Organization;
  use kartik\widgets\ActiveForm;
  use kartik\builder\Form;
  

  //Заболевания диагноз parent_id > 0
  $catList = ArrayHelper::index( ProductCat::find()->where(['>','parent_id',0])->asArray()->all(), 'id' );
  //Список организаций
  $orgList = ArrayHelper::index(Organization::find()->asArray()->all(), 'id');
  $specList = ArrayHelper::index(Specialist::find()->asArray()->all(), 'id');
  $specTypeList = ArrayHelper::index(SpecialistType::find()->asArray()->all(), 'id');
  $diagnosList = ArrayHelper::index(Diagnos::find()->asArray()->all(), 'id');

$css = <<<CSS

select.search_select {
  border: 0 none;
  width: 100%; border-bottom: 1px solid #A52024;
  border-left: 1px solid #A52024;
  padding: 3px 10px;
}

.select2-container--krajee .select2-selection {
    -webkit-box-shadow: none;
    box-shadow: none;
    background-color: #fff;
    border: 0;
	border-bottom: 1px solid #A52024;
    border-left: 1px solid #A52024;
    border-radius: 0;
    color: #000;
    font-size: 14px;
    outline: 0;
}
.select2-search {padding:0;margin:0;}
.select2-container .select2-search--inline .select2-search__field {
    font-style: normal;color: #000;font-size: 14px;

}
.select2-container .select2-search--inline .select2-search__field[placeholder] {
    font-style: normal;color: #000;font-size: 14px;

}
.select2-container--krajee .select2-selection--multiple {
    min-height: auto;
}

.select2-container--krajee .select2-selection--multiple .select2-search--inline .select2-search__field {height: 24px;}
.select2-container--krajee .select2-selection--multiple .select2-selection__choice {margin:0 0 0 6px;}

CSS;

$this->registerCss($css);

?>
<section class="block find">
  <form action="/search" method="get">
      <div class="block-container">
      <div class="find-block">
          <input type="text" name="q" value="<?= Yii::$app->request->get('q') ?>" placeholder="Введите ключевое слово или название заболевания" />
          <a href="#" class="add">Добавить параметры</a>
          <a href="#" class="big" onclick="$(this).parents('form')[0].submit()">НАЙТИ</a>
        </div>

    	 <!-- add-find -->
    	 <div class="add-find" style="display: <?= Yii::$app->controller->openAdvSearchBlock ? 'block' : 'none' ?>;">
      	 <div class="str">
        	 <div class="col">стоимость лечения</div>
        	 <div class="col">

              <input type="hidden" name="price_min"
                      value="<?=(int)Yii::$app->request->get('price_min')?>" />
              <input type="hidden" name="price_max"
                      value="<?=(int)Yii::$app->request->get('price_max')?>" />

          	 <div class="left">
            	 <input type="text" id="amount" readonly style="border:0;" />
            	 <div class="shkala">
                  <div id="slider-range"></div>
				            <p class="punkt">
                      <b>1000</b>
                      <b style="left:134px;">150000</b>
                      <b style="left:272px;">300000</b>
                      <b style="left:440px;">500000</b>
                </p>
              </div>
          	 </div>

        	 </div>
      	 </div>

      	 <div class="str">
          	 <div class="col">заболевание/диагноз</div>
          	 <div class="col">
            	 <div class="left">
                  <select name="diagnos" class="search_select">
                  <option value="0" <?=(!Yii::$app->request->get('diagnos')) ? 'selected="selected"' : '';?>>
                      Выбрать из списка
                  </option>
                  <?php foreach($diagnosList as $diagnos):?>
                      <?php if (Yii::$app->request->get('cat')==$diagnos['id']): ?>
                        <option value="<?=$diagnos['id'];?>" selected="selected">
                            <?=$diagnos['title'];?>
                        </option>
                      <?php else:?>
                          <option value="<?=$diagnos['id'];?>">
                            <?=$diagnos['title'];?>
                          </option>
                      <?php endif;?>

                  <?php endforeach;?>
                  </select>
               </div>
               <div style="display: none;" class="right">Вы можете уточнить диагноз <a href="#" class="add-but"></a></div>
          	 </div>
      	 </div>


      	 <!--div class="str">
          	 <div class="col">Категория</div>
          	 <div class="col">
            	 <div class="left">
                  <select name="cat" class="search_select">
                  <option value="0" <?=(!Yii::$app->request->get('cat')) ? 'selected="selected"' : '';?>>
                      Выбрать из списка
                  </option>
                  <?php foreach($catList as $cat):?>
                      <?php if (Yii::$app->request->get('cat')==$cat['id']): ?>
                        <option value="<?=$cat['id'];?>" selected="selected">
                            <?=$cat['title'];?>
                        </option>
                      <?php else:?>
                          <option value="<?=$cat['id'];?>">
                            <?=$cat['title'];?>
                          </option>
                      <?php endif;?>

                  <?php endforeach;?>
                  </select>
               </div>
               <div style="display: none;" class="right">Вы можете уточнить диагноз <a href="#" class="add-but"></a></div>
          	 </div>
      	 </div-->

      	 <div class="str">
        	 <div class="col">Клиники</div>
        	 <div class="col">
          	 <div class="left">
             
                <?php
	
                  echo kartik\widgets\Select2::widget([
                      'name' => 'org[]',
                      'value' => Yii::$app->request->get('org'), // initial value
                      'data' => ArrayHelper::map($orgList, 'id', 'title'),
                      'options' => ['placeholder' => 'Выбрать из списка ...', 'multiple' => true],
                      'pluginOptions' => [
                          'tags' => true,
                          'maximumInputLength' => 100,
                      ],
                  ]);
                  
?>


             </div>
             <div class="right"></div>
        	 </div>
      	 </div>

    	 	 <div class="str">

          	 <div class="col">Специализация врача</div>
          	 <div class="col">
          	     <div class="left">
                    <select name="spec_type" class="search_select">
                      <option value="0" <?=(!Yii::$app->request->get('spec_type')) ? 'selected="selected"' : '';?>>
                          Выбрать из списка
                      </option>
                      <?php foreach($specTypeList as $specType):?>
                          <?php if (Yii::$app->request->get('spec_type')==$specType['id']): ?>
                            <option value="<?=$specType['id'];?>" selected="selected">
                                <?=$specType['title'];?>
                            </option>
                          <?php else:?>
                              <option value="<?=$specType['id'];?>">
                                <?=$specType['title'];?>
                              </option>
                          <?php endif;?>

                      <?php endforeach;?>
                  </select>
                 </div>
                 <div class="right"></div>
          	 </div>
      	 </div>

  	 	 	 <div class="str">
      	   <div class="col">Врач</div>
      	   <div class="col">
          	   <div class="left">
                  <select name="spec" class="search_select">
                      <option value="0" <?=(!Yii::$app->request->get('spec')) ? 'selected="selected"' : '';?>>
                          Выбрать из списка
                      </option>
                      <?php foreach($specList as $spec):?>
                          <?php if (Yii::$app->request->get('spec')==$spec['id']): ?>
                            <option value="<?=$spec['id'];?>" selected="selected">
                                <?=$spec['first_name'];?>&nbsp;<?=$spec['last_name'];?>
                            </option>
                          <?php else:?>
                              <option value="<?=$spec['id'];?>">
                                <?=$spec['first_name'];?>&nbsp;<?=$spec['last_name'];?>
                              </option>
                          <?php endif;?>

                      <?php endforeach;?>
                  </select>
              </div>
              <div class="right"></div>
        	 </div>
      	 </div>

    	 </div>
    	 <!-- /add-find -->

      </div>
  </form>
</section>
