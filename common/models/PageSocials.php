<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_socials".
 *
 * @property int $id
 * @property string|null $social_title
 * @property string|null $social_icon
 * @property string|null $social_css
 * @property int|null $enabled
 *
 * @property PageSocialsServices[] $pageSocialsServices
 */
class PageSocials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_socials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['social_icon', 'social_css'], 'string'],
            [['social_title'], 'string', 'max' => 255],
            [['enabled'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('pagesocials','ID'),
            'social_title' => Yii::t('pagesocials','Social Title'),
            'social_icon' => Yii::t('pagesocials','Social Icon'),
            'social_css' => Yii::t('pagesocials','Social Css'),
            'enabled' => Yii::t('pagesocials','Enabled'),
        ];
    }

    /**
     * Gets query for [[PageSocialsServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPageSocialsServices()
    {
        return $this->hasMany(PageSocialsServices::className(), ['id_social' => 'id'])->where(['enabled' => 1]);
    }
}
