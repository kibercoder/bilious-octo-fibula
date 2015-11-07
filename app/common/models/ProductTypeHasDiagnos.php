<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_product_type_has_diagnos".
 *
 * @property integer $diagnos_id
 * @property integer $product_type_id
 *
 * @property ProductType $productType
 * @property Diagnos $diagnos
 */
class ProductTypeHasDiagnos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_type_has_diagnos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['diagnos_id', 'product_type_id'], 'required'],
            [['diagnos_id', 'product_type_id'], 'integer']
        ];
    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'diagnos_id' => Yii::t('app', 'Диагноз'),
            'product_type_id' => Yii::t('app', 'Тип продукта'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnos()
    {
        return $this->hasOne(Diagnos::className(), ['id' => 'diagnos_id']);
    }
}
