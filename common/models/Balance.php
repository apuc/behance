<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property int $id
 * @property int $user_id
 * @property int $views
 * @property int $likes
 */
class Balance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'balance';
    }

    /**
     * @param $user
     * @param $likes
     * @param $views
     */
    public static function create($user,$likes,$views)
    {
        $balance = new self;
        $balance-> user_id = $user;
        $balance->likes = $likes;
        $balance->views = $views;
        $balance->save();
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'views', 'likes'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('balance', 'ID'),
            'user_id' => 'Пользователь',
            'views' => Yii::t('balance', 'Views'),
            'likes' => Yii::t('balance', 'Likes'),
        ];
    }


    /**
     * @param $likes
     * @param $views
     * @return boolean
     */
    public function addBalance($likes,$views)
    {

       $this->likes += (integer)$likes;
       $this->views += (integer)$views;
       $this->save();

       return true;
    }



    /**
     * @param $likes
     * @param $views
     * @return bool
     */
    public function removeFromBalance($likes,$views)
    {

        $this->likes -= (integer)$likes;
        $this->views -= (integer)$views;
        $this->save();

        return true;
    }



    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}
