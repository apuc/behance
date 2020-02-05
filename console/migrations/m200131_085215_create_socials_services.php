<?php

use yii\db\Migration;
use VipIpRuClient\Request\Request;

/**
 * Class m200131_085215_create_socials_services
 */
class m200131_085215_create_socials_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $social_reference = [
            'vk' => 1,
            'tw' => 2,
            'fb' => 3,
            'inst' => 4,
            'yt' => 5,
            'ok' => 6,
            'twch' => 7,
            'rt' => 8
        ];

        $this->createTable('socials_services', [
            'id' => $this->primaryKey()->unsigned(),
            'id_soc' => $this->string(5),
            'type_id' => $this->integer()->unsigned(),
            'title' => $this->string(50),
            'title_short' => $this->string(50),
            'desc' => $this->string(50),
            'price' => $this->bigInteger()->comment('dollars*(10^6) per 1000')
        ]);

        $request = new Request();
        $request->setLink("https://api.vipip.ru/v0.1/social/tarifflist");
        $request->setParam('access_token', Yii::$app->params['access_token']);
        $socials = $request->get();

        foreach($socials as $social) {
            $this->insert('socials_services', [
                'id_soc' => $social_reference[$social->soc_code],
                'type_id' => $social->id,
                'title' => $social->title.' ('.$social->soc_code.')',
                'title_short' => $social->titleshort,
                'desc' => $social->desc,
                'price' => $social->priceadv * 1000000
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('socials_services');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_085215_create_socials_services cannot be reverted.\n";

        return false;
    }
    */
}
