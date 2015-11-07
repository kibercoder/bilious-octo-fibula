<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;

class OrderForm extends \yii\db\ActiveRecord
{

    public $card_number;
    public $card_name;
    public $card_term;
    public $card_code;
    
    
    /**
     * @inheritdoc
     */
    public function scenarios(){
        return [
            'order' => ['email', 'first_name', 'last_name', 'middle_name', 'birthday_date', 'phone', 'password', 'confirmpassword'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'card_number' => 'Номер на карте',
            'card_name' => 'Имя на карте',
            'card_term' => 'Срок окончания карты',
            'card_code' => 'Проверочный код',
        ];
    }

    public function rules()
    {

            $rules[] = [['card_number', 'card_name', 'card_term', 'card_code'], 'required', 'message' => 'Заполните обязательное поле'];
            $rules[] = [['card_number', 'card_name', 'card_term', 'card_code'], 'filter', 'filter' => 'trim'];
            $rules[] = [['card_code'], 'integer'];
            $rules[] = [['card_name','card_code'], 'string', 'min' => 3, 'message' => 'Длина имени не менее 3 символов'];
            $rules[] = [['card_term'], 'date', 'format'=>'dd.mm.yyyy', 'message' => 'Неверный формат'];

        return $rules;
    }

    
    /**
     * Сохраняем наш заказ и отправляем письмо пользователю.
     */
    public function saveOrder($user, $product, $post)
    {

        $order = new Order();
        $order->user_id = $user->id;
        $order->summ = $product['price'];
        $order->created_datetime = date('Y-m-d H:i:s');
        $order->finished_datetime = date('Y-m-d H:i:s');
        
        if ($order->save(false)) {
          
            \Yii::$app->mailer->compose(
            ['html' => 'order-html', 'text' => 'order-text'], 
            ['user' => $user, 'product' => $product, 'post' => $post])
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' робот'])
            ->setTo($user->email)
            ->setSubject('Заказ товара - ' . \Yii::$app->name)
            ->send();
            return true;
        }

        return false;
    }
    
    

}


?>