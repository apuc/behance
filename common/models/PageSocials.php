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
            [['social_title', 'social_icon', 'social_css'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'social_title' => 'Social Title',
            'social_icon' => 'Social Icon',
            'social_css' => 'Social Css',
        ];
    }

    /**
     * Gets query for [[PageSocialsServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPageSocialsServices()
    {
        return $this->hasMany(PageSocialsServices::className(), ['id_social' => 'id']);
    }
}
