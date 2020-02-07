<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%behance_prices}}`.
 */
class m200207_073709_create_behance_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('behance_prices', [
            'id' => $this->primaryKey(),
            'service' => $this->string(), //likes, views, to save existing logic it's the best way
            'price' => $this->bigInteger(), //price per 1 * exponent from Settings, again, for simplicity of it
        ]);
        $this->insert('behance_prices', ['service' => 'likes', 'price' => 50000]); // 5 cents
        $this->insert('behance_prices', ['service' => 'views', 'price' => 50000]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('behance_prices');
    }
}
