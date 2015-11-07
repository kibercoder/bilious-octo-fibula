<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_specialist_has_type".
 *
 * @property integer $spec_id
 * @property integer $spec_type_id
 *
 * @property SpecialistType $specType
 * @property Specialist $spec
 */
class SpecialistHasType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_specialist_has_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spec_id', 'spec_type_id'], 'required'],
            [['spec_id', 'spec_type_id'], 'integer']
        ];
    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'spec_id' => Yii::t('app', 'Специалист'),
            'spec_type_id' => Yii::t('app', 'Тип спициалиста'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecType()
    {
        return $this->hasOne(SpecialistType::className(), ['id' => 'spec_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpec()
    {
        return $this->hasOne(Specialist::className(), ['id' => 'spec_id']);
    }
    
    
    /**
     * Извлекаем список продуктов
     */
    public static function loadList($select = '*', $where = [], $order = null, $limit = null){

        return self::find()
            ->select($select)
            ->with('specType')
            ->with('spec')
            ->where($where)
            ->limit($limit)
            ->orderBy($order)
            ->asArray()
            ->all();

    }
}
