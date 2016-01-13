<?php

use yii\db\Schema;
use yii\db\Migration;

class m160113_131711_user_table_creation extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ( 'mysql' === Yii::$app->db->driverName) {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string()->unique()->notNull(),
                'name' => $this->string(45)->notNull(),
                'password_hash' => $this->string(60)->notNull(),
                'auth_key' => $this->string(32),
                'created_at' => $this->integer(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
