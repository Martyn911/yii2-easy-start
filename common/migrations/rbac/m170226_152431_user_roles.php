<?php

use yii\db\Migration;

class m170226_152431_user_roles extends Migration
{
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_MANAGER = 'manager';
    const ROLE_USER = 'user';
    
    public $auth = 'authManager';

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->auth = \Yii::$app->get('authManager');
    }

    public function up()
    {
        $this->auth->removeAll();
        $user = $this->auth->createRole(self::ROLE_USER);
        $this->auth->add($user);
        $manager = $this->auth->createRole(self::ROLE_MANAGER);
        $this->auth->add($manager);
        $this->auth->addChild($manager, $user);
        $admin = $this->auth->createRole(self::ROLE_ADMINISTRATOR);
        $this->auth->add($admin);
        $this->auth->addChild($admin, $manager);
        $this->auth->assign($admin, 1);
        $this->auth->assign($manager, 2);
        $this->auth->assign($user, 3);
    }
    public function down()
    {
        $this->auth->remove($this->auth->getRole(self::ROLE_ADMINISTRATOR));
        $this->auth->remove($this->auth->getRole(self::ROLE_MANAGER));
        $this->auth->remove($this->auth->getRole(self::ROLE_USER));
    }
}
