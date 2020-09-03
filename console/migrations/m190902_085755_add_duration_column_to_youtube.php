<?php

use yii\db\Migration;

/**
 * Class m190902_085755_add_duration_column_to_youtube
 */
class m190902_085755_add_duration_column_to_youtube extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('youtube_queue', 'duration', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('youtube_queue', 'duration');
    }
}
