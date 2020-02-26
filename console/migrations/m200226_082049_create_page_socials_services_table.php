<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_socials_services}}`.
 */
class m200226_082049_create_page_socials_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_socials_services}}', [
            'id' => $this->primaryKey(),
            'id_social' => $this->integer()->unsigned(),
            'service_title' => $this->string(),
            'service_description' => $this->text(), // mb html-formatted?
            'service_seo' => $this->string(),
            'service_page_link' => $this->string(),
            'service_order_link' => $this->string()
        ]);
        $this->addForeignKey('fk_socials_services_socials', 'page_socials_services', 'id_social',
                                                                'page_socials', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page_socials_services}}');
    }
}
