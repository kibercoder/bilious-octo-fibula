<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Восстановление доступа';
$this->params['breadcrumbs'][] = $this->title;

$css =<<<CSS

#reset-password-form button {
    background: #a52025;
    color: #fff;
    border: 0;
    overflow: visible;
    outline: 0;
    text-transform: uppercase;
    padding: 5px 10px;
    margin: 0 0 0 -10px;
    border-radius: 14px;
    display: inline-block;
    cursor: pointer;    
}

#reset-password-form label {
    width: 150px; float: left;
}

CSS;

$this->registerCss($css);

?>

<!-- block1 -->
  <section class="block block1">
      <div class="block-container">
      
        <div class="site-reset-password">
            <h1><?= Html::encode($this->title) ?></h1>
        
              <div class="col-lg-12">
                <?php if(Yii::$app->session->hasFlash('resultSentMail')): ?>
                    <p class="alert alert-danger" role="alert" style="color: #a52025;">
                        <?= Yii::$app->session->getFlash('resultSentMail') ?>
                    </p>
                <?php endif; ?>
            </div>
        
            <p>Введите свой новый пароль:</p>
        
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
      </div>
  </section>
