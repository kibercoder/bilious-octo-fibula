<?php

namespace common\models;

use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "tbl_organization".
 *
 * @property integer $id
 * @property string $title
 * @property string $keywords
 * @property string $body
 * @property string $address
 * @property string $phone
 * @property string $phone2
 * @property string $email
 * @property string $city
 * @property string $region
 * @property integer $priority
 *
 * @property Service[] $services
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body', 'address', 'phone'], 'required'],
            [['body', 'intro', 'doc_body'], 'string'],
            [['email'], 'email'],
            [['priority', 'type_index'], 'integer'],
            [['title', 'keywords'], 'string', 'max' => 255],
            [['metro'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 150],
            [['phone', 'phone2', 'city', 'region'], 'string', 'max' => 30],
            [['main_image'], 'safe'],
            [['icon_image'], 'string'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'title' => 'Заголовок',
            'keywords' => 'Ключевые слова',
            'intro' => 'Краткое описание',
            'body' => 'Полное описание',
            'doc_body' => 'Договор',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'phone2' => 'Второй телефон',
            'email' => 'Email',
            'city' => 'Город',
            'region' => 'Область',
            'main_image' => Yii::t('app', 'Изображение'),
            'metro' => Yii::t('app', 'Метро'),
            'priority' => Yii::t('app', 'Приоритет (для баннеров)'),
            'type_index' => Yii::t('app', 'Список - type_index '),
            'icon_image' => Yii::t('app', 'Иконка'),
        ];
    }

    public function getTypeIndexList($index = null){
        $list = [
            1 => "Организация",
            2 => "Мед учреждение",
        ];

        if( $index !== null ){
            return array_key_exists($index, $list) ? $list[$index] : '';
        }

        return $list;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['organization_id' => 'id']);
    }

    public static function getPhones($data)
    {
        $list = [];

        if( isset($data['phone']) ){
            $list[] = $data['phone'];
        }

        if( isset($data['phone2']) ){
            $list[] = $data['phone2'];
        }

        return $list;
    }

    public function getProducts(){
        return $this->hasMany(Product::className(), ['organization_id' => 'id']);
    }

    public static function loadList($select = '*', $where = [], $order = null, $limit = null ){
        return self::find()
            ->select($select)
            ->where($where)
            ->limit($limit)
            ->orderBy($order)
            ->asArray()
            ->all();
    }

    /**
     * Получаем случайные записи модели
     */
    public static function getRandom($limit = 1, $where = []) {

        return self::find()->select('*')->where($where)->orderBy(new Expression('rand()'))->limit($limit)->asArray()->all();

    }

}
