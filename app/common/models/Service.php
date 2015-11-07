<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_service".
 *
 * @property integer $id
 * @property string $title
 * @property string $keywords
 * @property string $intro
 * @property string $body
 * @property integer $type_id
 * @property integer $organization_id
 * @property integer $price
 * @property string $code
 *
 * @property Organization $organization
 * @property ServiceType $type
 * @property ServiceProduct[] $serviceProducts
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'type_id', 'organization_id', 'price', 'code'], 'required'],
            [['body'], 'string'],
            [['type_id', 'organization_id', 'price'], 'integer'],
            [['title', 'keywords', 'intro'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 100]
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
            'type_id' => 'Тип услуги',
            'organization_id' => 'Клиника',
            'price' => 'Цена',
            'code' => 'Код услуги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ServiceType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceProducts()
    {
        return $this->hasMany(ServiceProduct::className(), ['service_id' => 'id']);
    }
}
