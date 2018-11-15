<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proxy".
 *
 * @property int $id
 * @property string $ip
 */
class Proxy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proxy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('proxy', 'ID'),
            'ip' => Yii::t('proxy', 'Ip'),
        ];
    }

    public function Fill($data)
    {
        Yii::$app->db->createCommand()->setRawSql("TRUNCATE TABLE {$this::tableName()}")->execute();
        Yii::$app->db->createCommand()->batchInsert($this::tableName(), ['ip'], $data)->execute();
    }
}
