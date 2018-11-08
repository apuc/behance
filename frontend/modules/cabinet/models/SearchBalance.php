<?php

namespace frontend\modules\cabinet\models;

use common\models\Accounts;
use common\models\Debug;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\cabinet\models\Balance;
use yii\helpers\ArrayHelper;

/**
 * SearchBalance represents the model behind the search form of `frontend\modules\cabinet\models\Balance`.
 */
class SearchBalance extends Balance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'accounts_id', 'views', 'likes'], 'integer'],
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
	    $account_id = Accounts::find()->where(['user_id'=>Yii::$app->user->identity->id])->select('id')->one();
        $query = Balance::find()->where(['accounts_id'=>$account_id]);
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
            'views' => $this->views,
            'likes' => $this->likes,
        ]);

        return $dataProvider;
    }
}
