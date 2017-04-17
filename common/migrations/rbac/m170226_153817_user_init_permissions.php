<?php

use yii\db\Migration;

class m170226_153817_user_init_permissions extends Migration
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
        $managerRole = $this->auth->getRole(self::ROLE_MANAGER);
        $loginToBackend = $this->auth->createPermission('loginToBackend');
        $this->auth->add($loginToBackend);
        $this->auth->addChild($managerRole, $loginToBackend);
    }
    public function down()
    {
        $this->auth->remove($this->auth->getPermission('loginToBackend'));
    }
}
