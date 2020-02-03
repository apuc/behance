<?php

use yii\db\Migration;

/**
 * Class m200203_120413_add_column_inputs_social_services
 */
class m200203_120413_add_column_inputs_social_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('socials_services', 'inputs', $this->string());
        $this->update(
            'socials_services',
            ['inputs' => 'link'],
            ['id' => [31, 10, 11, 12, 19, 8, 9, 27, 28, 29, 30]]
        );
        $this->update(
            'socials_services',
            ['inputs' => 'link;sex;age;friends;answer'],
            ['id' => 24]
        );
        $this->update(
            'socials_services',
            ['inputs' => 'msg;sex;age;friends'],
            ['id' => 16]
        );
        $this->update(
            'socials_services',
            ['inputs' => 'link;friends'],
            ['id' => [18, 4, 5]]
        );
        $this->update(
            'socials_services',
            ['inputs' => 'msg;friends'],
            ['id' => [15]]
        );
        $this->update(
            'socials_services',
            ['inputs' => 'link;sex;age;friends'],
            ['id' => [1, 2, 3, 7, 17, 22, 23, 13, 14, 20, 21]]
        );
        $this->update(
            'socials_services',
            ['inputs' => 'link;sex;friends'],
            ['id' => [6, 32, 33, 34, 35]]
        );

        // disabled till further notice
        $this->update('socials_services', ['status' => 0], ['id' => [25, 26]]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('socials_services', 'inputs');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_120413_add_column_inputs_social_services cannot be reverted.\n";

        return false;
    }
    */
}
