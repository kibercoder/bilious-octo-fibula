<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $intro
 * @property string $body
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $state_index
 * @property integer $main_flag
 * @property string $created_datetime
 * @property string $start_time
 * @property string $start_date
 * @property string $preview_image
 * @property string $doc_file
 * @property integer $noforeign_id
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
            [['title', 'intro', 'body', 'user_id'], 'required'],
            [['intro', 'body'], 'string'],
            [['user_id', 'category_id', 'state_index', 'main_flag', 'noforeign_id'], 'integer'],
            [['created_datetime', 'start_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['start_time'], 'string', 'max' => 8],
            [['preview_image', 'doc_file'], 'safe'],
            //[['doc_file'], 'file', 'extensions'=>'doc, docx, xls, xlsx, pdf']
        ];
    }

    function getStateIndexList($index = null){
        $list = [
            1 => "Item 1",
            2 => "Item 2",
            3 => "Item 3",
        ];

        if( $index !== null ){
            return array_key_exists($index, $list) ? $list[$index] : '';
        }

        return $list;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Заголовок'),
            'intro' => Yii::t('app', 'Описание'),
            'body' => Yii::t('app', 'Текст'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'category_id' => Yii::t('app', 'Категория'),
            'state_index' => Yii::t('app', 'Простой список'),
            'main_flag' => Yii::t('app', 'Главная'),
            'created_datetime' => Yii::t('app', 'Время создания'),
            'start_time' => Yii::t('app', 'Время начала'),
            'start_date' => Yii::t('app', 'Дата начала'),
            'preview_image' => Yii::t('app', 'Изображение'),
            'doc_file' => Yii::t('app', 'Документ'),
            'noforeign_id' => Yii::t('app', 'Noforeign ID'),
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
