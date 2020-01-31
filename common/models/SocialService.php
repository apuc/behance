<?php

namespace common\models;

use common\models\Social;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property int $id_soc
 * @property int $type_id
 * @property string $title
 * @property string $title_short
 * @property string $desc
 * @property int $price
 * @property \common\models\Social $social
 */
class SocialService extends \yii\db\ActiveRecord
{
    private $_social;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socials_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_soc', 'type_id', 'price'], 'integer'],
            [['title', 'title_short', 'desc'], 'safe'],
            [['title', 'title_short', 'desc'], 'string', 'max' => 50],
        ];
    }

    public function getSocial()
    {
        if (isset($this->_social)) {
            return $this->_social;
        } else {
            $this->_social = Social::findOne(['id' => $this->id_soc]);
            return $this->_social;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('social', 'ID'),
            'soc_code' => Yii::t('social', 'SOC'),
            'title' => Yii::t('social', 'Title'),
            'title_short' => Yii::t('social', 'Title Short'),
            'desc' => Yii::t('social', 'Description'),
            'price' => Yii::t('social', 'Price'),
        ];
    }
}
