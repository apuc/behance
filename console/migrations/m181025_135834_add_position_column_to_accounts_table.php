<?php

use yii\db\Migration;

/**
 * Handles adding position to table `accounts`.
 */
class m181025_135834_add_position_column_to_accounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('accounts', 'behance_id', $this->integer()->unsigned());
        $this->addColumn('accounts', 'display_name', $this->string('255'));
        $this->addColumn('accounts', 'username', $this->string('255'));
        $this->addColumn('accounts', 'image', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('accounts', 'behance_id');
        $this->dropColumn('accounts', 'display_name');
        $this->dropColumn('accounts', 'username');
        $this->dropColumn('accounts', 'image');
    }
}
