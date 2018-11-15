<?php

namespace backend\modules\cases\models;

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
            [['id', 'views', 'likes', 'status'], 'integer'],
            [['name', 'img', 'term'], 'safe'],
            [['price'], 'number'],
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
            'views' => $this->views,
            'likes' => $this->likes,
            'status' => $this->status,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'status', $this->term]);

        return $dataProvider;
    }
}
