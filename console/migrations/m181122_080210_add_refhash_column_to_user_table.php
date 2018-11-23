<?php

use yii\db\Migration;

/**
 * Handles adding refhash to table `user`.
 */
class m181122_080210_add_refhash_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','ref_hash',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','ref_hash');
    }
}
