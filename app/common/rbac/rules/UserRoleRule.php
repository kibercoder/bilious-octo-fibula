<?php

namespace common\rbac\rules;

use Yii;
use yii\rbac\Rule;
use common\models\User;

/**
 * Checks if user group matches
 */
class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        // Если пользователь не является гостем
        // присвиваем ему роль
        if (!Yii::$app->user->isGuest) {

            // Берем список ролей
            $roles = require( __DIR__ . '/../items.php' );

            // Сверяем role текущего юзера и идентификатор
            foreach($roles as $name => $data){
                if( Yii::$app->user->identity->role == $data['id'] ){
                    if ($item->name == $name) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
