<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%support_questions}}`.
 */
class m200506_084159_add_date_column_to_support_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('support_questions', 'date_add', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('support_questions', 'date_add');
    }
}
