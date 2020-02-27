<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_socials}}`.
 */
class m200226_080053_create_page_socials_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_socials}}', [
            'id' => $this->primaryKey()->unsigned(),
            'social_title' => $this->string(),
            'social_icon' => $this->text(),
            'social_css' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page_socials}}');
    }
}
