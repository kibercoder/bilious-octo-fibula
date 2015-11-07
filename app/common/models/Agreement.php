<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_agreement".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $default_flag
 *
 * @property Product[] $products
 */
class Agreement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agreement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body'], 'string'],
            [['default_flag'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Загловок'),
            'body' => Yii::t('app', 'Описание'),
            'default_flag' => Yii::t('app', 'Флаг'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['agreement_id' => 'id']);
    }
}
