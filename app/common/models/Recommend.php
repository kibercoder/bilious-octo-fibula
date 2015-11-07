<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_recommend".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $body
 * @property string $profession
 * @property string $photo_image
 * @property integer $list_order
 */
class Recommend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recommend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro', 'body'], 'string'],
            [['list_order'], 'integer'],
            [['name', 'profession'], 'string', 'max' => 255],
            [['photo_image'], 'string']
        ];
    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя'),
            'intro' => Yii::t('app', 'Краткое описание'),
            'body' => Yii::t('app', 'Описание'),
            'profession' => Yii::t('app', 'Профессия'),
            'photo_image' => Yii::t('app', 'Фото'),
            'list_order' => Yii::t('app', 'Сортировка'),
        ];
    }
}
