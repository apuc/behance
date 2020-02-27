<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

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
 * @property int|null $enabled
 * @property string|null $service_seo_title
 * @property string|null $service_seo_descr
 * @property string|null $service_seo_keywords
 *
 * @property PageSocials $social
 */
class PageSocialsServices extends \yii\db\ActiveRecord
{
    public $service_seo_title;
    public $service_seo_descr;
    public $service_seo_keywords;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_socials_services';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'service_title',
                'slugAttribute' => 'service_page_link',
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_social', 'service_page_link', 'service_title', 'enabled'], 'required'],
            [['id_social', 'enabled'], 'integer'],
            [['service_description', 'service_seo', 'service_page_link', 'service_order_link', 'service_seo_title', 'service_seo_descr', 'service_seo_keywords'], 'string'],
            [['service_title'], 'string', 'max' => 255],
            [['id_social'], 'exist', 'skipOnError' => true, 'targetClass' => PageSocials::className(), 'targetAttribute' => ['id_social' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('pagesocials', 'ID'),
            'id_social' => Yii::t('pagesocials','Id Social'),
            'service_title' => Yii::t('pagesocials','Service Title'),
            'service_description' => Yii::t('pagesocials','Service Description'),
            'service_seo' => Yii::t('pagesocials','Service Seo'),
            'service_page_link' => Yii::t('pagesocials','Service Page Link'),
            'service_order_link' => Yii::t('pagesocials','Service Order Link'),
            'enabled' => Yii::t('pagesocials','Enabled'),
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
