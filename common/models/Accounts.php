<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property string $url
 * @property string $title
 * @property int $behance_id
 * @property string $display_name
 * @property string $username
 * @property string $image
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['behance_id'], 'integer'],
            [['image'], 'string'],
            [['url', 'title', 'display_name', 'username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('accounts', 'ID'),
            'url' => Yii::t('accounts', 'Url'),
            'title' => Yii::t('accounts', 'Title'),
            'behance_id' => Yii::t('accounts', 'Behance ID'),
            'display_name' => Yii::t('accounts', 'Display Name'),
            'username' => Yii::t('accounts', 'Username'),
            'image' => Yii::t('accounts', 'Image'),
        ];
    }
}
