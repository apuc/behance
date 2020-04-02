<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property string $name
 * @property string $soc_code
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'soc_code'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['soc_code'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'name' => Yii::t('social', 'Name'),
            'soc_code' => Yii::t('social', 'SOC'),
        ];
    }
}
