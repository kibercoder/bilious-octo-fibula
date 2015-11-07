<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_diagnos".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $intro
 *
 * @property ProductTypeHasDiagnos[] $productTypeHasDiagnos
 * @property ProductType[] $productTypes
 */
class Diagnos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_diagnos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body', 'intro'], 'string'],
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
            'title' => Yii::t('app', 'Заголовок'),
            'body' => Yii::t('app', 'Описание'),
            'intro' => Yii::t('app', 'Краткое описание'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypeHasDiagnos()
    {
        return $this->hasMany(ProductTypeHasDiagnos::className(), ['diagnos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['id' => 'product_type_id'])->viaTable('tbl_product_type_has_diagnos', ['diagnos_id' => 'id']);
    }
}
