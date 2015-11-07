<?php
namespace frontend\controllers\page;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\components\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\models\Recommend;
use yii\helpers\ArrayHelper;


/**
 * Site controller
 */
class DefaultController extends Controller
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
                        'actions' => ['reviews'],
                        'allow' => true,
                        //'roles' => ['moderator']
                    ],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Главная страница
     */
    public function actionIndex()
    {
        /*$this->showSearchBlock = true;
        
        return $this->render('index',[
            'orgList' => Organization::loadList('*', 'priority > 0', 'priority desc'),
            'productList' => Product::loadList('*', 'priority > 0', 'priority desc'),
            'specList' => Specialist::loadList(),
        ]);*/
    }





}
