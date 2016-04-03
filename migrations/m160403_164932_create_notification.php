<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notification`.
 */
class m160403_164932_create_notification extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'subject' => $this->string()->notNull(),
            'body' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'from' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk_notification_user', 'notification', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_notification_user', 'notification');
        $this->dropTable('notification');
    }
}
