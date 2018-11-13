<?php

namespace common\models;

use Yii;
use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;


/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property int $user_id
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
            [['behance_id','user_id'], 'integer'],
            [['image'], 'string'],
            [['url', 'title', 'display_name', 'username'], 'string', 'max' => 255],
            [['url'], 'required'],
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
            'user_id'=> Yii::t('accounts', 'User'),
        ];
    }



    public function parseAccount(BehanceService $service,$user_id = null)
    {

        $account = $service->account;

        if($account)
        {
            if($this->find()->where(['behance_id' => $account->behanceId])->limit(1)->one())
            {
                throw  new \Exception('Аккаунт уже добавленн!');
            }

            $this->behance_id = (integer)$account->behanceId;
            $this->display_name = (string)$account->displayName;
            $this->username = (string)$account->username;
            $this->url = (string)$account->url;
            $this->image = (string)$account->image;
            $this->user_id = ($user_id != null) ? (integer)$user_id : Yii::$app->user->identity->id;
            $this->save(false);
        }

    }



    public static function getRandomAccount()
    {
        $accounts_ids = Accounts::find()->where(['user_id'=>Yii::$app->user->identity->id])->select('id')->all();

        if(empty($accounts_ids))
        {
            return false;
        }

        $id = rand(0,count($accounts_ids)-1);
        return Accounts::find()->where(['id'=>$accounts_ids[$id]->id])->one();
    }


    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

}
