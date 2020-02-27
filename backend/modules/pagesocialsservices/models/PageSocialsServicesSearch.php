<?php

namespace backend\modules\pagesocialsservices\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PageSocialsServices;

/**
 * PageSocialsServicesSearch represents the model behind the search form of `common\models\PageSocialsServices`.
 */
class PageSocialsServicesSearch extends PageSocialsServices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_social', 'enabled'], 'integer'],
            [['service_title', 'service_description', 'service_seo', 'service_page_link', 'service_order_link'], 'safe'],
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
        $query = PageSocialsServices::find();

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
            'id_social' => $this->id_social,
        ]);

        $query->andFilterWhere(['like', 'service_title', $this->service_title])
            ->andFilterWhere(['like', 'service_description', $this->service_description])
            ->andFilterWhere(['like', 'service_seo', $this->service_seo])
            ->andFilterWhere(['like', 'service_page_link', $this->service_page_link])
            ->andFilterWhere(['like', 'service_order_link', $this->service_order_link])
            ->andFilterWhere(['like', 'enabled', $this->enabled]);

        return $dataProvider;
    }
}
