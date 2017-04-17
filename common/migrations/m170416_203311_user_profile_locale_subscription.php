<?php

use yii\db\Migration;
use yii\db\Schema;

class m170416_203311_user_profile_locale_subscription extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}', 'locale', Schema::TYPE_STRING);
        $this->addColumn('{{%profile}}', 'subscription', Schema::TYPE_SMALLINT);
    }

    public function down()
    {
        $this->dropColumn('{{%profile}}', 'locale');
        $this->dropColumn('{{%profile}}', 'subscription');
    }
}
