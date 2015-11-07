<?php
namespace frontend\controllers\post;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\widgets\LinkPager;

use common\models\Post;
use common\models\PostSearch;


/**
 * Site controller
 */
class PostController extends Controller
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
                        'actions' => ['index', 'post'],
                        'allow' => true,
                        //'roles' => ['@']
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

    public function actionIndex($page=1)
    {
        $query = Post::find()->where('state_index = 1')->orderBy('created_datetime DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>5,'pageSize'=>5]);
        $allPosts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $query = Post::find()->where('state_index = 1 AND main_flag = 1')->orderBy('created_datetime DESC');
        $mainPosts = $query->offset(0)
            ->limit(2)
            ->all();

        return $this->render('index', [
            'all_posts' => $allPosts,
            'main_posts' => $mainPosts,
            'pages' => $pages
        ]);
    }

    public function actionPost($id)
    {
        $model = $this->findModel($id);
        return $this->render('post',array('model'=>$model));
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}

