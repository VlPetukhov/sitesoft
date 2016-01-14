<?php

use yii\db\Schema;
use yii\db\Migration;

class m160113_175436_message_table_creation extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ('mysql' === Yii::$app->db->driverName) {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%message}}',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'message' => $this->text()->notNull(),
                'created_at' => $this->integer(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'message__user_id_fk',
            '{{%message}}',
            '[[user_id]]',
            '{{%user}}',
            '[[id]]',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('message__user_id_fk', '{{%message}}');
        $this->dropTable('{{%message}}');
    }
}
