<?php

use yii\db\Migration;

/**
 * Class m181106_071919_create_accounts_works_foreign_key
 */
class m181106_071919_create_accounts_works_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-work-account_id',
            'works',
            'account_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-work-account_id',
            'works',
            'account_id',
            'accounts',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-work-account_id',
            'works'
        );


        $this->dropIndex(
            'idx-work-account_id',
            'works'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181106_071919_create_accounts_works_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
