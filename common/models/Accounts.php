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


    public function parseAccount($url) {

        $service = BehanceService::create(new BehanceAccount());
        $account = $service->getAccount($url);

        if($account)
        {
            if($this->find()->where(['behance_id' => $account->behanceId])->one())
            {
                return 'Аккаунт уже добавлен!';
            }

            $this->behance_id = (integer)$account->behanceId;
            $this->display_name = (string)$account->displayName;
            $this->username = (string)$account->username;
            $this->url = (string)$account->url;
            $this->image = (string)$account->image;
            $this->user_id = Yii::$app->user->identity->id;
            $this->save();

            return true;
        }

        return 'Не удалось получить аккаунт! Неверный url адресс!';
    }



    public static function getRandomAccount()
    {
        $accounts_ids = Accounts::find()->where(['user_id'=>Yii::$app->user->identity->id])->select('id')->all();
        $id = rand(0,count($accounts_ids)-1);
        return Accounts::find()->where(['id'=>$accounts_ids[$id]->id])->one();
    }

}
