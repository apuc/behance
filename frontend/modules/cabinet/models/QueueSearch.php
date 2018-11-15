<?php

namespace frontend\modules\cabinet\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Queue;
use common\models\Accounts;
use common\models\Works;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * QueueSearch represents the model behind the search form of `common\models\Queue`.
 */
class QueueSearch extends Queue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'work_id', 'likes_work', 'views_work', 'account_views'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $account_id = Accounts::find()->where(['user_id'=>Yii::$app->user->identity->id])->select('id')->all();
        $account_id = ArrayHelper::getColumn($account_id,'id');
        $account_id = implode(',',$account_id);

        $works_id = Works::find()->where("account_id IN({$account_id})")->select('id')->all();
        $works_id = ArrayHelper::getColumn($works_id,'id');
        $works_id = implode(',',$works_id);

        $query = Queue::find()->where("work_id IN({$works_id})")->orderBy("id desc");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'work_id' => $this->work_id,
            'likes_work' => $this->likes_work,
            'views_work' => $this->views_work,
            'account_views' => $this->account_views,
        ]);

        return $dataProvider;
    }
}
