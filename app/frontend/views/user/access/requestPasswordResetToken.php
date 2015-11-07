<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = 'Восстановление доступа';
$this->params['breadcrumbs'][] = $this->title;

$css =<<<CSS

#request-password-reset-form button {
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

#request-password-reset-form label {
    width: 150px; float: left;
}

CSS;

$this->registerCss($css);

?>

<!-- block1 -->
  <section class="block block1">
      <div class="block-container">

        <div class="site-request-password-reset">
            <h1><?= Html::encode($this->title) ?></h1>
        
            <p>
                Введите email, указанный при регистрации.<br>
                На него будут высланы инструкции по восстановлению доступа.
            </p>
            
            <p>
                <?php if(Yii::$app->session->hasFlash('resultSentMail')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= Yii::$app->session->getFlash('resultSentMail') ?>
                    </div>
                <?php endif; ?>
            </p>
            
            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                        <?= $form->field($model, 'email') ?>
                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
      </div>
  </section>
