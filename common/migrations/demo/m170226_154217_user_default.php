<?php

use yii\db\Migration;
use dektrium\user\models\User;
use dektrium\user\helpers\Password;

class m170226_154217_user_default extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => Password::hash('admin'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'confirmed_at' => time(),
            'flags' => User::NEW_EMAIL_CONFIRMED,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 2,
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password_hash' => Password::hash('manager'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'confirmed_at' => time(),
            'flags' => User::NEW_EMAIL_CONFIRMED,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 3,
            'username' => 'user',
            'email' => 'user@example.com',
            'password_hash' => Password::hash('user123'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'confirmed_at' => time(),
            'flags' => User::NEW_EMAIL_CONFIRMED,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }
    public function safeDown()
    {
        $this->delete('{{%user}}', [
            'id' => [1, 2, 3]
        ]);
    }
}
