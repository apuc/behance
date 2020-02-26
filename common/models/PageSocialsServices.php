<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_socials_services".
 *
 * @property int $id
 * @property int|null $id_social
 * @property string|null $service_title
 * @property string|null $service_description
 * @property string|null $service_seo
 * @property string|null $service_page_link
 * @property string|null $service_order_link
 *
 * @property PageSocials $social
 */
class PageSocialsServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_socials_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_social'], 'integer'],
            [['service_description'], 'string'],
            [['service_title', 'service_seo', 'service_page_link', 'service_order_link'], 'string', 'max' => 255],
            [['id_social'], 'exist', 'skipOnError' => true, 'targetClass' => PageSocials::className(), 'targetAttribute' => ['id_social' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_social' => 'Id Social',
            'service_title' => 'Service Title',
            'service_description' => 'Service Description',
            'service_seo' => 'Service Seo',
            'service_page_link' => 'Service Page Link',
            'service_order_link' => 'Service Order Link',
        ];
    }

    /**
     * Gets query for [[Social]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(PageSocials::className(), ['id' => 'id_social']);
    }
}
