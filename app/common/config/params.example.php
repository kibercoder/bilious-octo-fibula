<?php

Yii::setAlias('@uploadroot', '@common/../../www/uploads');
Yii::setAlias('@upload', '/uploads');

return [
    'project.name' => 'Yii2 Pack',
    //'adminEmail' => 'admin@example.com',
    //'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'db.host' => 'localhost',
    'db.user' => 'upmc',
    'db.pass' => '12345',
    'db.name' => 'yii2',
];
