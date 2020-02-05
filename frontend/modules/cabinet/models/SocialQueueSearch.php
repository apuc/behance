<?php

namespace frontend\modules\cabinet\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SocialQueue;

/**
 * SocialQueueSearch represents the model behind the search form of `common\models\SocialQueue`.
 */
class SocialQueueSearch extends SocialQueue
{

    public function  __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'link_id', 'type_id', 'status', 'balance'], 'integer'],
            [['dt_add'], 'safe'],
            [['url'], 'string'],
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
       $query = SocialQueue::find();
       // add conditions that should always apply here
       $dataProvider = new ActiveDataProvider([
           'query' => $query,
           'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
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
           'link_id' => $this->link_id,
           'type_id' => $this->type_id,
           'dt_add' => $this->dt_add,
           'status' => $this->status,
           'url' => $this->url,
           'balance' => $this->balance
       ]);
       return $dataProvider;

    }
}
