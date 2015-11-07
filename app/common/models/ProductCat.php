<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_cat}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 *
 * @property ProductCat $parent
 * @property ProductCat[] $productCats
 * @property ProductType[] $productTypes
 */
class ProductCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['menu_flag', 'list_order'], 'integer'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название категории'),
            'parent_id' => Yii::t('app', 'Родительская категория'),
            'list_order' => Yii::t('app', 'Сортировка'),
            'menu_flag' => Yii::t('app', 'Выводить в меню?'),
        ];
    }


    /**
     * @Возвращаем 0 или 1 для вывода в меню
     */
    public function getMenuIndexList($index = null){
        $list = [
            0 => 'Нет',
            1 => 'Да',
        ];

        if( $index !== null ){
            return array_key_exists($index, $list) ? $list[$index] : '';
        }

        return $list;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ProductCat::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCats()
    {
        return $this->hasMany(ProductCat::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['cat_id' => 'id']);
    }

    static public function loadMenu(){

        $list = self::find()->where(['menu_flag' => '1'])->orderBy('list_order ASC')->asArray()->all();
        $tree = [];

        foreach( $list as $item ){
            if( $item['parent_id'] == 0 ){
                $tree[$item['id']] = [ 'data' => $item, 'list' => [] ];
            }
        }

        foreach( $list as $item ){
            if( $item['parent_id'] > 0 ){
                $tree[ $item['parent_id'] ]['list'][ $item['id'] ] = $item;
            }
        }

        return $tree;
    }
}
