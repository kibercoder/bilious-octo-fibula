<?php

namespace common\models;

use Yii;
use yii\helpers\Html;


/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $is_publish
 * @property integer $is_main
 * @property integer $category_id
 * @property string $title
 * @property string $intro
 * @property string $body
 * @property string $image_file
 * @property integer $user_id
 * @property string $date_created
 *
 * @property PostCategory $category
 * @property User $user
 * @property PostTag[] $postTags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_publish', 'is_main', 'category_id', 'user_id'], 'integer'],
            [['title', 'intro', 'body', 'user_id'], 'required'],
            [['intro', 'body'], 'string'],
            [['date_created'], 'safe'],
            [['title'], 'string', 'max' => 255],

            [['image_file'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'is_publish' => Yii::t('app', 'Опубликовано'),
            'is_main' => Yii::t('app', 'Главная'),
            'category_id' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Заголовок'),
            'intro' => Yii::t('app', 'Описание'),
            'body' => Yii::t('app', 'Текст'),
            'image_file' => Yii::t('app', 'Изображение'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'date_created' => Yii::t('app', 'Время создания'),
        ];
    }

    /**
     * See https://github.com/mongosoft/yii2-upload-behavior
     */
    public function behaviors()
    {
         return [
            [
                'class' => \mongosoft\file\UploadImageBehavior::className(),
                'attribute' => 'image_file',
                'scenarios' => ['default'],
                //'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'path' => '@uploadroot/post/image_file/{id}',
                'url' => '@upload/post/image_file/{id}',
                //'thumbs' => [
                //    'thumb' => ['width' => 400, 'quality' => 90],
                //    'preview' => ['width' => 200, 'height' => 200],
                //],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }



}
