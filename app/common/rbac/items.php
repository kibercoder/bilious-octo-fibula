<?php

Use yii\rbac\Item;

return [
    'user' => [
        'id' => 1,
        'type' => Item::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => ['guest'],
    ],
    'admin' => [
        'id' => 10,
        'type' => Item::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => ['moderator', 'user'],
        'ruleName' => 'userRole',
    ],
    'moderator' => [
        'id' => 20,
        'type' => Item::TYPE_ROLE,
        'description' => 'Модератор',
        'children' => ['guest'],
        'ruleName' => 'userRole',
    ],

];
