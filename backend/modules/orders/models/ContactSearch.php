<?php

namespace backend\modules\orders\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactForm;

/**
 * ContactSearch represents the model behind the search form of `common\models\ContactForm`.
 */
class ContactSearch extends ContactForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'email', 'link', 'message', 'dt_add'], 'safe'],
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
        $query = ContactForm::find()->orderBy('status');

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'dt_add', $this->dt_add]);

        return $dataProvider;
    }
}
