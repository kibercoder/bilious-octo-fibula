<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_product_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $cat_id
 *
 * @property Product[] $products
 * @property ProductCat $cat
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type_index'], 'required'],
            [['title_mid', 'title_full'], 'string', 'max' => 150],
            [['body'], 'string'],
            [['cat_id', 'type_index'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['icon_image'], 'string'],
            [['diagnoses_list'], 'safe'],
        ];
    }

    /**
     * See https://github.com/mongosoft/yii2-upload-behavior
     */
    public function behaviors()
    {
         return [
            ['class'=>\voskobovich\behaviors\ManyToManyBehavior::className(),'relations' => ['diagnoses_list' => 'diagnoses'],],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'body' => 'Описание',
            'cat_id' => 'Категория',
            'icon_image' => Yii::t('app', 'Иконка'),
            'title_mid' => Yii::t('app', 'Название - title_mid '),
            'title_full' => Yii::t('app', 'Название - title_full '),
            'type_index' => Yii::t('app', 'Тип'),
            'diagnoses_list' => Yii::t('app', 'Список диагнозов'),
        ];
    }

    public function getTypeIndexList($index = null){
        $list = [
            1 => "Диагностика",
            2 => "Лечение",
        ];

        if( $index !== null ){
            return array_key_exists($index, $list) ? $list[$index] : '';
        }

        return $list;
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypeHasDiagnos()
    {
        return $this->hasMany(ProductTypeHasDiagnos::className(), ['product_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnoses()
    {
        return $this->hasMany(Diagnos::className(), ['id' => 'diagnos_id'])->viaTable('tbl_product_type_has_diagnos', ['product_type_id' => 'id']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['type_product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(ProductCat::className(), ['id' => 'cat_id']);
    }
}
