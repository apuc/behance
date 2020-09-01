<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reviews`.
 */
class m181112_104421_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey()->unsigned(),
            'photo' => $this->string(),
            'name' => $this->string(),
            'nick_name' => $this->string(),
            'content' => $this->text(),
            'dt_add' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reviews');
    }
}
