<?php
return [
    'adminEmail' => env('ADMIN_EMAIL'),
    'robotEmail' => env('ROBOT_EMAIL'),
    'user.passwordResetTokenExpire' => 3600,
    'availableLocales'=>[
        'en'=>'English (US)',
        'ru'=>'Русский (РФ)',
        'uk'=>'Українська (Україна)',
    ],
];
