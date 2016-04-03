<?php

use yii\db\Migration;

/**
 * Handles adding the columns  * for table `notification`.
 */
class m160403_182147_add_reviewed_to_notification extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('notification', 'reviewed', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('notification', 'reviewed');
    }
}
