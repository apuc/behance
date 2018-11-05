<?php

namespace common\models;

use Yii;
use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property int $account_id
 * @property string $behance_id
 * @property string $url
 * @property string $name
 * @property string $image
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_id'], 'integer'],
	        [['behance_id', 'url', 'name', 'image'], 'safe'],
            [['behance_id', 'url', 'name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('works', 'ID'),
            'account_id' => Yii::t('works', 'Account ID'),
            'behance_id' => Yii::t('works', 'Behance ID'),
            'url' => Yii::t('works', 'Url'),
            'name' => Yii::t('works', 'Name'),
            'image' => Yii::t('works', 'Image'),
        ];
    }


    public function parseWorks($url)
    {
        $service = BehanceService::create(new BehanceAccount());
        $account =$service->getAccount($url);

        if($account)
        {
            $works = $service->getWorks();

            if($works)
            {
                $id = Accounts::find()->where(['behance_id'=>$account->behanceId])->all();
                $id = $id[0]->id;

                foreach ($works as $key => $val)
                {
                    $work_bd = new Works();
                    $work_bd->behance_id = (string)$val->behanceId;
                    $work_bd->image = (string)$val->image;
                    $work_bd->account_id = (integer)$id;
                    $work_bd->url = (string)$val->url;
                    $work_bd->name = (string)$val->name;
                    $work_bd->save();
                }

                return true;
            }

            return 'Не удалось получить работы!';
        }

    }
}
