<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;

$css =<<<CSS

#login-form2 button {
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

#login-form2 label {
    width: 150px; float: left;
}

CSS;

$this->registerCss($css);


?>

<!-- block1 -->
  <section class="block block1">
      <div class="block-container">

        <div class="site-login">
        
              <div class="col-lg-12">
                <?php if(Yii::$app->session->hasFlash('resultSentMail')): ?>
                    <p class="alert alert-danger" role="alert" style="color: #a52025;">
                        <?= Yii::$app->session->getFlash('resultSentMail') ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'login-form2']); ?>
                    
                        <?= $form->field($model, 'username', ['labelOptions'=> ['label' =>'Логин']]) ?>
                        <?= $form->field($model, 'password', ['labelOptions'=> ['label' =>'Пароль']])->passwordInput() ?>
                        <?= $form->field($model, 'rememberMe', ['labelOptions'=> ['label' =>'Запомнить меня']])->checkbox() ?>
                        <div style="color:#999;margin:1em 0">
                            <?= Html::a('Восстановить доступ', ['user/access/request-password-reset']) ?>.
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
      </div>
  </section>
