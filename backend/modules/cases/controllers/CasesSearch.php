<?php

namespace backend\modules\cases\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cases\models\Cases;

/**
 * CasesSearch represents the model behind the search form of `backend\modules\cases\models\Cases`.
 */
class CasesSearch extends Cases
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'behance_id', 'views', 'likes'], 'integer'],
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
        $query = Cases::find();

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
            'behance_id' => $this->behance_id,
            'views' => $this->views,
            'likes' => $this->likes,
        ]);

        return $dataProvider;
    }
}
