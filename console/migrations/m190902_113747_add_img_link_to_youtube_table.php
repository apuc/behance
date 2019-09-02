<?php

use yii\db\Migration;

/**
 * Class m190902_113747_add_img_link_to_youtube_table
 */
class m190902_113747_add_img_link_to_youtube_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('youtube_queue', 'img', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('youtube_queue','img');
    }
}
