<?php

namespace common\components;

use yii\rbac\PhpManager;

class AuthManager extends PhpManager{

    public function init(){

        parent::init();

        $this->add(new UserRoleRule());
    }
}
