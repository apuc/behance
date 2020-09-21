<?php

namespace backend\modules\balancecash\models;

use backend\modules\settings\models\Settings;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\balancecash\models\BalanceCash;

/**
 * BalanceCashSearch represents the model behind the search form of `backend\modules\balancecash\models\BalanceCash`.
 */
class BalanceCashSearch extends BalanceCash
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'amount'], 'integer'],
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
        $query = BalanceCash::find()->with('user');

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
        $exp = intval(Settings::getSetting('balance_exponent'));
        $query->andFilterCompare('amount', '>='.(int)$params['BalanceCashSearch']['amount'] * $exp);
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
