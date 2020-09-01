<?php

namespace backend\modules\orders\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrdersSearch represents the model behind the search form of `backend\modules\orders\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'accounts_id', 'cases_id', 'status'], 'integer'],
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
        $query = Orders::find();

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
            'accounts_id' => $this->accounts_id,
            'cases_id' => $this->cases_id,
            'status' => $this->status,
            'dt_add' => $this->dt_add,
        ]);

        return $dataProvider;
    }
}
