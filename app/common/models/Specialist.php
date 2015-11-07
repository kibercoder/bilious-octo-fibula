<?php

namespace common\models;

use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "tbl_specialist".
 *
 * @property integer $id
 * @property string $intro
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $photo_image
 * @property string $phone
 * @property string $email
 *
 * @property SpecialistHasHospital[] $specialistHasHospitals
 * @property Organization[] $orgs
 * @property SpecialistHasType[] $specialistHasTypes
 * @property SpecialistType[] $specTypes
 */
class Specialist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_specialist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro', 'body'], 'string'],
            [['middle_name'], 'required'],
            [['email'], 'email'],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
            [['photo_image'], 'string'],
            [['orgs_list'], 'safe'],
            [['specTypes_list'], 'safe']
        ];
    }

    /**
     * See https://github.com/mongosoft/yii2-upload-behavior
     */
    public function behaviors()
    {
         return [
            ['class'=>\voskobovich\behaviors\ManyToManyBehavior::className(),'relations' => ['orgs_list' => 'orgs'],],
        ['class'=>\voskobovich\behaviors\ManyToManyBehavior::className(),'relations' => ['specTypes_list' => 'specTypes'],],
        ];
    }

    /**
     * Механизм Behavior, встроенный в Yii не позволяет задать
     * несколько одинаковых Behavior на разные поля и спользвать их
     * поэтому для некоторых компонентов прихдится дописывать заплатки
     */
    public function getUploadUrl($image){
        return $this->getBehavior($image)->getUploadUrl($image);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'intro' => Yii::t('app', 'Краткое описание'),
            'body' => Yii::t('app', 'Полное описание'),
            'first_name' => Yii::t('app', 'Имя'),
            'last_name' => Yii::t('app', 'Фамилия'),
            'middle_name' => Yii::t('app', 'Отчество'),
            'photo_image' => Yii::t('app', 'Фото'),
            'phone' => Yii::t('app', 'Телефон'),
            'email' => Yii::t('app', 'Email'),
            'orgs_list' => Yii::t('app', 'Список из таблицы (tbl_specialist_has_hospital)'),
            'specTypes_list' => Yii::t('app', 'Список из таблицы (tbl_specialist_has_type)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialistHasHospitals()
    {
        return $this->hasMany(SpecialistHasHospital::className(), ['spec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrgs()
    {
        return $this->hasMany(Organization::className(), ['id' => 'org_id'])->viaTable('tbl_specialist_has_hospital', ['spec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialistHasTypes()
    {
        return $this->hasMany(SpecialistHasType::className(), ['spec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecTypes()
    {
        return $this->hasMany(SpecialistType::className(), ['id' => 'spec_type_id'])->viaTable('tbl_specialist_has_type', ['spec_id' => 'id']);
    }
    
    /**
     * Получаем случайные записи модели
     */
    public static function getRandom($limit = 1, $where = [], $joinWith = []) {
        return self::find()->select('*')->joinWith($joinWith)->where($where)->orderBy(new Expression('rand()'))->limit($limit)->asArray()->all();
    }


    public static function loadList($select = '*', $where = []){
        return self::find()
            ->select($select)
            ->where($where)
            ->asArray()
            ->all();
    }
    
}
