<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160403_163029_create_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull(),
        ]);

        $this->insert('user', [
            'id' => '100',
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'email' => 'admin@example.com',
        ]);

        $this->insert('user', [
            'id' => '101',
            'username' => 'demo',
            'password' => Yii::$app->security->generatePasswordHash('demo'),
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'email' => 'demo@example.com',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
