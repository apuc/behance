<?php

use yii\db\Migration;

/**
 * Class m190902_134647_add_name_dislike_like_views
 */
class m190902_134647_add_name_dislike_like_views extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('youtube_queue', 'name', $this->string(255));
        $this->addColumn('youtube_queue', 'like', $this->integer());
        $this->addColumn('youtube_queue', 'dislike', $this->integer());
        $this->addColumn('youtube_queue', 'count_views', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('youtube_queue', 'name');
        $this->dropColumn('youtube_queue', 'like');
        $this->dropColumn('youtube_queue', 'dislike');
        $this->dropColumn('youtube_queue', 'count_views');
    }
}
