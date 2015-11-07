<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $summ
 * @property integer $status_index
 * @property string $created_datetime
 * @property string $finished_datetime
 *
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status_index'], 'required'],
            [['user_id', 'summ', 'status_index'], 'integer'],
            [['created_datetime', 'finished_datetime'], 'safe']
        ];
    }

    
    
    function getStatusIndexList($index = null){
        $list = [
          1 => "Новый",
          2 => "Оплачен",
          3 => "Выполнен",
        ];

        if( $index !== null ){
          return array_key_exists($index, $list) ? $list[$index] : '';
        }
        return $list;
    }
        
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'summ' => Yii::t('app', 'Сумма заказа'),
            'status_index' => Yii::t('app', 'Статус заказа'),
            'created_datetime' => Yii::t('app', 'Создание заказа'),
            'finished_datetime' => Yii::t('app', 'Окончание заказа'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
