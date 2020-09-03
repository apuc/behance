<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%socials}}`.
 */
class m200902_102331_add_status_column_to_socials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%socials}}', 'status', $this->integer()->defaultValue(1)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%socials}}', 'status');
    }
}
