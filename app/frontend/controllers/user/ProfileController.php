<?php
namespace frontend\controllers\user;

use Yii;
use frontend\models\ProfileForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Order;

/**
 * Site controller
 */
class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionProfile()
    {
        // Устанавливаем сценарий валидации
        $form = new ProfileForm();
        $form->setScenario('profile');

        // Загружаем в форму данные пользователя
        $User = Yii::$app->user->getIdentity();
        $form->setUser( $User );

        if ( $form->load(Yii::$app->request->post())  && $form->validate() ) {
          
            // Сохраняем пользователя с данными из формы
            if ( $form->save($User) ) {

                Yii::$app->session->setFlash(
                    'success',
                    'Данные успешно сохранены.'
                );
            } else {
                Yii::$app->session->setFlash(
                    'error',
                    'Произошла ошибка при сохранении данных пользователя.'
                );
            }

            return $this->refresh();
        }
        
        $orders = Order::findAll(['user_id' => $User->id]);
        
        $template = (Yii::$app->request->get('edit')) ? 'profile_edit' : 'profile';
        
        $form->birthday_date = date('d.m.Y',strtotime($form->birthday_date));
        
        return $this->render($template, [
            'model' => $form,
            'orders' => $orders,
        ]);
    }
}
