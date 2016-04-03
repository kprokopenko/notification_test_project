<?php

use yii\db\Migration;

/**
 * Handles the creation for table `notification_type`.
 */
class m160401_163557_create_notification_template extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('notification_template', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'event_code' => $this->string()->notNull(),
            'from' => $this->string()->notNull(),
            'to' => $this->smallInteger()->notNull()->defaultValue(0),
            'subject' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'type' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('notification_template');
    }
}
