<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use yii\validators\Validator;

use yii\filters\VerbFilter;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $password;
    public $confirmpassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password' => 'Пароль',
            'email' => 'Email',
            'phone' => 'Телефон',
            'status' => 'Состояние',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'username' => 'Логин',
            'role' => 'Роль',
            'password' => 'Пароль',
            'confirmpassword' => 'Повторите пароль',
            'birthday_date' => 'Дата рождения',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество'
        ];
    }

    public function beforeSave($insert) {
        
        $this->username = $this->email;
      
        if (strlen($this->password)>=6) {
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'delete' => ['post'],
                  'delete-multiple' => ['post'],
              ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

      $rules[] = [['email'], 'required'];
      $rules[] = [['role', 'status'], 'integer'];
      $rules[] = [['email'], 'email'];
      $rules[] = [['email', 'phone'], 'string', 'max' => 255];
      $rules[] = [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 30];
      $rules[] = [['birthday_date'], 'date', 'format'=>'Y-m-d', 'message' => 'Неверный формат'];
      
      //$rules[] = ['username', 'match', 'pattern' => '/^[a-z0-9]{3,18}$/i', 'message' => 'Только латинские буквы и цифры от 3 до 18 символов'];
      
      
      
      $rules[] = [['phone', 'mobile_phone'], 'match', 'pattern'=>'/^( +)?((\+?7|8) ?)?((\(\d{3}\))|(\d{3}))?( )?(\d{3}[\- ]?\d{2}[\- ]?\d{2})( +)?$/i', 'message' => 'Не верно введён телефон'];
  
      $rules[] = [['email'], 'unique', 'message' => 'Такой пользователь уже существует.'];
      
      $rules[] = ['status', 'default', 'value' => self::STATUS_ACTIVE];
      $rules[] = ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]];

        $rules[] = [['password', 'confirmpassword'], 'string', 'min' => 6, 'message' => 'Длина пароля не менее 6 символов'];
        $rules[] = [['password', 'confirmpassword'], 'filter', 'filter' => 'trim'];
        $rules[] = ['confirmpassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Значение «Повторите пароль» должно быть повторено в точности!'];
        
        $rules[] = ['confirmpassword', 'required', 'when' => function ($model) {
            return strlen($model->password)>0;
        }, 'whenClient' => "function (attribute, value) {
            return $('#password').val().toString().length > 0;
        }"];

        $rules[] = ['password', 'required', 'when' => function ($model) {
            return yii::$app->controller->action->id == 'create';
        }, 'whenClient' => "function (attribute, value) {
            return $('#password').val().toString().length > 0;
        }"];
        
      return $rules;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
      
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    
    public function getRoles($id = null){
      
        $list = require dirname(__DIR__).'/rbac/items.php';
        $roles = array();
        foreach($list as $k => $v){
          if (count($v)>0) {
            $roles[$v['id']] = $v['description'];
          }
        }
        return isset($roles[$id]) ? $roles[$id] : $roles;
    }
    
    public function getStatuses($id = null){
        $list = [ 
           self::STATUS_ACTIVE => 'Активен', 
           self::STATUS_DELETED => 'Заблокирован'
        ];
  
        return isset($list[$id]) ? $list[$id] : $list;
    }
    
      
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
