<?php
namespace frontend\controllers\feedback;

use Yii;
use frontend\models\FeedbackForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;

use common\models\Organization;
use common\models\Product;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionFeedback()
    {
        $model = new FeedbackForm();

        // Отправка запроса + валидация
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {

                Yii::$app->session->setFlash(
                    'success',
                    'Спасибо за ваше обращение, оно будет рассмотрено в ближайшее время.'
                );

            } else {

                Yii::$app->session->setFlash(
                    'error',
                    'Произошла ошибка при отправке email.'
                );

            }

            return $this->refresh();

        } else {
          
            $orgList = Organization::find()->select('*')->asArray()->all();
            $productList = Product::find()->select('*')->asArray()->all();

            return $this->render('feedback', [
                'model' => $model,
                'orgList' => $orgList,
                'productList' => $productList,
            ]);
        }
    }

}
