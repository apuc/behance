<?php

use yii\db\Migration;

/**
 * Class m200131_075131_create_socials
 */
class m200131_075131_create_socials extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('socials', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(20),
            'soc_code' => $this->string(5)
        ]);
        $this->insert('socials', ['name' => 'VK', 'soc_code' => 'vk']);
        $this->insert('socials', ['name' => 'Twitter', 'soc_code' => 'tw']);
        $this->insert('socials', ['name' => 'Facebook', 'soc_code' => 'fb']);
        $this->insert('socials', ['name' => 'Instagram', 'soc_code' => 'inst']);
        $this->insert('socials', ['name' => 'YouTube', 'soc_code' => 'yt']);
        $this->insert('socials', ['name' => 'Odnoklassniki', 'soc_code' => 'ok']);
        $this->insert('socials', ['name' => 'Twitch.tv', 'soc_code' => 'twch']);
        $this->insert('socials', ['name' => 'RuTube', 'soc_code' => 'rt']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('socials');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_075131_create_socials cannot be reverted.\n";

        return false;
    }
    */
}
