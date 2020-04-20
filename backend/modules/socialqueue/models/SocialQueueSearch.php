<?php

namespace backend\modules\socialqueue\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SocialQueue;

/**
 * Class SocialQueueSearch
 * @package backend\modules\historycash\models
 */
class SocialQueueSearch extends SocialQueue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type_id'], 'integer'],
            [['dt_add'], 'safe'],
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
        $query = SocialQueue::find()->with('user','type')->orderBy("id desc");

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
            'user_id' => $this->user_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'dt_add', $this->dt_add]);

        return $dataProvider;
    }
}