<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact_form`.
 */
class m181108_125055_create_contact_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contact_form', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'link' => $this->string(),
            'message' => $this->text(),
            'dt_add'=>$this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('contact_form');
    }
}
