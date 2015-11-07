<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_specialist_type".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 *
 * @property SpecialistHasType[] $specialistHasTypes
 * @property Specialist[] $specs
 */
class SpecialistType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_specialist_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body'], 'string'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialistHasTypes()
    {
        return $this->hasMany(SpecialistHasType::className(), ['spec_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecs()
    {
        return $this->hasMany(Specialist::className(), ['id' => 'spec_id'])->viaTable('tbl_specialist_has_type', ['spec_type_id' => 'id']);
    }
}
