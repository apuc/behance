<?php

namespace backend\modules\pagesocials\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PageSocials;

/**
 * PageSocialSearch represents the model behind the search form of `common\models\PageSocials`.
 */
class PageSocialSearch extends PageSocials
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'enabled'], 'integer'],
            [['social_title', 'social_css'], 'safe'],
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
        $query = PageSocials::find();

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

        $query->andFilterWhere(['like', 'social_title', $this->social_title])
            ->andFilterWhere(['like', 'social_icon', $this->social_icon])
            ->andFilterWhere(['like', 'social_css', $this->social_css])
            ->andFilterWhere(['like', 'enabled', $this->enabled]);

        return $dataProvider;
    }
}
