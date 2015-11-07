<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_service_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $keywords
 * @property string $intro
 * @property string $body
 *
 * @property Service[] $services
 */
class ServiceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_service_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'keywords', 'intro', 'body'], 'required'],
            [['intro', 'body'], 'string'],
            [['title', 'keywords'], 'string', 'max' => 255]
        ];
    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'keywords' => 'Ключевые слова',
            'intro' => 'Описание',
            'body' => 'Текст',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['type_id' => 'id']);
    }
}
