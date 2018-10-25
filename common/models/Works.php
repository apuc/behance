<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property int $account_id
 * @property string $behance_id
 * @property string $url
 * @property string $name
 * @property string $preview
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id'], 'integer'],
            [['behance_id', 'url', 'name', 'preview'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('works', 'ID'),
            'account_id' => Yii::t('works', 'Account ID'),
            'behance_id' => Yii::t('works', 'Behance ID'),
            'url' => Yii::t('works', 'Url'),
            'name' => Yii::t('works', 'Name'),
            'preview' => Yii::t('works', 'Preview'),
        ];
    }
}
