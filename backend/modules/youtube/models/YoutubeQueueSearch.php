<?php

namespace backend\modules\youtube\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\YoutubeQueue;

/**
 * YoutubeQueueSearch represents the model behind the search form of `common\models\YoutubeQueue`.
 */
class YoutubeQueueSearch extends YoutubeQueue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'views'], 'integer'],
            [['url'], 'safe'],
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
        $query = YoutubeQueue::find();

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
        ]);

        $query->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
