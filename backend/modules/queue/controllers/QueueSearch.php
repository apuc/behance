<?php

namespace backend\modules\queue\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\queue\models\Queue;

/**
 * QueueSearch represents the model behind the search form of `backend\modules\queue\models\Queue`.
 */
class QueueSearch extends Queue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'work_id', 'likes_count', 'views_count'], 'integer'],
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
        $query = Queue::find();

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
            'likes_count' => $this->likes_count,
            'views_count' => $this->views_count,
        ]);

        return $dataProvider;
    }
}
