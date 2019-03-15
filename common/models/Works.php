<?php

namespace common\models;

use Yii;
use common\behance\BehanceService;
use common\behance\lib\BehanceAccount;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property int $account_id
 * @property int $start_views
 * @property int $start_likes
 * @property int $current_likes
 * @property int $current_views
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
            [['behance_id', 'url', 'name', 'image', 'start_views', 'start_likes'], 'safe'],
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
            'account_id' => Yii::t('works', 'Аккаунт'),
            'start_likes' => Yii::t('works', 'Изначально лайков'),
            'start_views' => Yii::t('works', 'Изначально просмотров'),
            'behance_id' => Yii::t('works', 'Behance ID'),
            'url' => Yii::t('works', 'Url'),
            'name' => Yii::t('works', 'Name'),
            'image' => Yii::t('works', 'Картинка'),
        ];
    }


    /**Парсит и сохраняет работы аккаунта
     * @param BehanceService $service
     * @param bool $isUpdate
     * @return int
     * @throws \common\behance\lib\BehanceApiException
     */
    public function parseWorks(BehanceService $service, $isUpdate = false)
    {
        $works = $service->getWorks();

        if ($works)
        {
            $id = Accounts::find()->where(['behance_id' => $service->account->behanceId])->all();
            $id = $id[0]->id;

            $works_aded = 0;
            $works_in_db = array();

            if ($isUpdate) {
                $works_in_db = Works::find()->where(['account_id' => $id])->select('behance_id')->all();
                $works_in_db = ArrayHelper::getColumn($works_in_db, 'behance_id');
            }


            foreach ($works as $val) {

                if (in_array($val->behanceId, $works_in_db)) {
                    continue;
                }

                $work_bd = new Works();
                $work_bd->behance_id = (string)$val->behanceId;
                $work_bd->image = (string)$val->image;
                $work_bd->account_id = (integer)$id;
                $work_bd->url = (string)$val->url;
                $work_bd->name = (string)$val->name;
                $work_bd->start_likes = (string)$val->startViews;
                $work_bd->start_views = (string)$val->startLikes;
                $work_bd->save();
                $works_aded++;

            }

            return $works_aded;
        }

        throw new \Exception("Не удалось получить работы!");

    }


    /** Случайные работы для виджета телефона
     * @param $account_id
     * @param $count
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public static function getRandomWorks($account_id, $count)
    {
        $works_ids = Works::find()->where(['account_id' => $account_id])->select('id')->all();

        if (empty($works_ids)) {
            return false;
        }

        $rand_ids = array();

        for ($i = 0; $i < $count; $i++) {
            $rand_ids[] = $works_ids[rand(0, count($works_ids) - 1)]->id;
        }

        $rand_ids = implode(',', $rand_ids);
        return Works::find()->where("id IN({$rand_ids})")->all();
    }


    /**
     * Получает текущее кол-во лайков и просмотров работы
     */
    public function getCurrentStats()
    {
       $service = new BehanceService(new BehanceAccount());
       $url = "http://www.behance.net/v2/projects/{$this->behance_id}?api_key={$service->account->token}";
       $res = $service->account->behanceApiRequest($url);

       $this->current_likes = $res->project->stats->appreciations;
       $this->current_views = $res->project->stats->views;
    }


    /**связь с аккаунтом
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(),['id'=>'account_id']);
    }
}
