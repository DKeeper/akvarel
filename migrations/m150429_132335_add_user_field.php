<?php

use yii\db\Schema;
use yii\db\Migration;
use webvimark\modules\UserManagement\UserManagementModule;

class m150429_132335_add_user_field extends Migration
{
    public function up()
    {
        $this->addColumn(Yii::$app->getModule('user-management')->user_table,'age','TINYINT NULL DEFAULT NULL');
    }

    public function down()
    {
        echo "m150429_132335_add_user_field has been reverted.\n";
    }
}
