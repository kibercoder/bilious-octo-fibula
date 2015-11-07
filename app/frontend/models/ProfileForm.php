<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ProfileForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmpassword;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $birthday_date;
    public $phone;
    

    // Данными которого управляет форма (для режима профиля)
    public $user;

    public function setUser(User $User){
        $this->setAttributes( $User->toArray() );
        $this->user = $User;
    }

    /**
     * @inheritdoc
     */
    public function scenarios(){
        return [
            'profile' => ['email', 'first_name', 'last_name', 'middle_name', 'birthday_date', 'phone', 'password', 'confirmpassword'],
            'signup' => ['email', 'first_name', 'last_name', 'middle_name', 'birthday_date', 'phone',/*'password', 'confirmpassword'*/],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Mail',
            'password' => 'Пароль',
            'confirmpassword' => 'Повторите пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'birthday_date' => 'День рождения',
            'phone' => 'Телефон',
        ];
    }

    public function rules()
    {
        $rules = [

            [['first_name', 'email', 'last_name', 'middle_name', 'birthday_date', 'phone'], 'required', 'message' => 'Заполните обязательное поле'],
            [['email', 'first_name', 'last_name', 'middle_name', 'birthday_date', 'phone', 'password', ], 'filter', 'filter' => 'trim'],
            
            [['birthday_date'], 'date', 'format'=>'dd.mm.yyyy', 'message' => 'Неверный формат'],

            //['username', 'string', 'min' => 2, 'max' => 255, 'message' => 'Неверная длина поля'],
            
            [['phone'], 'match', 'pattern'=>'/^( +)?((\+?7|8) ?)?((\(\d{3}\))|(\d{3}))?( )?(\d{3}[\- ]?\d{2}[\- ]?\d{2})( +)?$/i', 'message' => 'Не верно введён телефон'],
            
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 30],
            
            ['email', 'email', 'message' => 'Некорректный email'],

            //['password', 'string', 'min' => 6, 'message' => 'Длина пароля не менее 6 символов'],

            // signup scenario
            //['password', 'required', 'on' => 'signup', 'message' => 'Заполните обязательное поле'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с указанным именем уже существует в системе', 'on' => 'signup'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой email уже есть', 'on' => 'signup'],

        ];

        // profile scenario
        if( $this->user ){

            //$rules[] = ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с указанным именем уже существует в системе', 'filter' => ['!=', 'username', $this->user->username], 'on' => 'profile'];
            
            $rules[] = ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с указанным email уже существует в системе', 'filter' => ['!=', 'email', $this->user->email], 'on' => 'profile'];
            
            $rules[] = [['password', 'confirmpassword'], 'string', 'min' => 6, 'message' => 'Длина пароля не менее 6 символов'];
            $rules[] = [['password', 'confirmpassword'], 'filter', 'filter' => 'trim'];
            $rules[] = ['confirmpassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Значение «Повторите пароль» должно быть повторено в точности!'];
        
            $rules[] = ['confirmpassword', 'required', 'when' => function ($model) {
                return strlen($model->password)>0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#profileform-password').val().toString().length > 0;
            }"];
    
            $rules[] = ['password', 'required', 'when' => function ($model) {
                return yii::$app->controller->action->id == 'create';
            }, 'whenClient' => "function (attribute, value) {
                return $('#profileform-password').val().toString().length > 0;
            }"];
            
            

        }
        
        return $rules;

    }

    /**
     * Save user profile.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save(User $user)
    {

        if ($this->validate()) {

            //$user->username = $this->username;
            $user->email = $user->username = $this->email;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->middle_name = $this->middle_name;
            $user->birthday_date = date('Y-m-d',strtotime($this->birthday_date));
            $user->phone = $this->phone;

            if( strlen($this->password)>=6 ){
                $user->setPassword($this->password);
                $user->password = $this->password;
            }
            
            if ($user->save(false)) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
      
        if ($this->validate()) {

            $user = new User();
            //$user->username = $this->username;
            $user->email = $user->username = $this->email;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->middle_name = $this->middle_name;
            $user->birthday_date = date('Y-m-d',strtotime($this->birthday_date));
            $user->phone = $this->phone;
            
            $password = isset($password) ? $password : $this->generate_password(8);

            if( strlen($password)>=6 ){
                $user->setPassword($password);
                $user->generateAuthKey();
                $user->password = $password;
            }

            if ($user->save(false)) {
              
                \Yii::$app->mailer->compose(
                ['html' => 'signUp-html', 'text' => 'signUp-text'], 
                ['user' => $user])
                ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' робот'])
                ->setTo($this->email)
                ->setSubject('Регистрационные данные ' . \Yii::$app->name)
                ->send();
                return $user;
                
            }
        }

        return null;
    }
    
    /**
        Генератор пароля $number - длина пароля
     **/
    
    public function generate_password($number) {
      
        $arr = array('a','b','c','d','e','f',
                     'g','h','i','j','k','l',
                     'm','n','o','p','r','s',
                     't','u','v','x','y','z',
                     'A','B','C','D','E','F',
                     'G','H','I','J','K','L',
                     'M','N','O','P','R','S',
                     'T','U','V','X','Y','Z',
                     '1','2','3','4','5','6',
                     '7','8','9','0','.',',',
                     '(',')','[',']','!','?',
                     '&','^','%','@','*','$',
                     '<','>','/','|','+','-',
                     '{','}','`','~');
        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < $number; $i++)
        {
          // Вычисляем случайный индекс массива
          $index = rand(0, count($arr) - 1);
          $pass .= $arr[$index];
        }
        return $pass;
        
    }
    
}
