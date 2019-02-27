<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('settings', 'ID'),
            'key' => Yii::t('settings', 'Key'),
            'value' => Yii::t('settings', 'Value'),
        ];
    }

    public static function createSeoSetting($data)
    {
        $key = $data['page_name'];
        unset($data['page_name']);
        unset($data['_csrf-backend']);

        $setting = new self();
        $setting->key = "seo_{$key}";
        $setting->value = json_encode($data);
        $setting->insert(false);
    }

    public static function getSetting($key)
    {
       $setting = Settings::find()->where("settings.key='{$key}'")->limit(1)->one();
       return $setting->value;
    }
}
